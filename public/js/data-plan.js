function formatValues(elemResource){
    var value = elemResource.val().toUpperCase();
    if(value.lastIndexOf('GB') != -1){
        value = value.replace('GB','') * 1 * 1024;
    }
    else if(value.lastIndexOf('MB') != -1){
        value = value.replace('MB','') * 1;
    }
    else if(value.lastIndexOf('DAYS') != -1){
        value = value.replace('DAYS','') * 1 * 24;
    }
    else if(value.lastIndexOf('HRS') != -1){
        value = value.replace('HRS','') * 1;
    }
    elemResource.val(value);
}//end formatValues
var url = "/member/data-plan";
//function for deleting specified data plan
function deleteDataPlan(id,page){
    let response = confirm("Are you sure you want to delete this data plan?\n Click OK to delete or cancel to go back");
    if(response){
        $.get(url+"/"+id, function(data, status){
            if (status == "success") {
                displayDataPlans(page);
                alert(data);
            }
            else {
                alert("An error occurred.");
            }
        })
    }
}
//fetch data plans form the db
function displayDataPlans(page = 1){
    $.get(url+"?page="+page, function(data, status){
        if (status == "success") {
            //alert("Succeeded! "+ data.data[0].title);
            var dataPlanHTML = "<div class = 'col-md-10 offset-md-1'>";
            //reduce current page by 1 if its not page 1 for table S/N
            data.current_pageNew = (data.current_page>1)? data.current_page - 1:data.current_page;
            dataPlanHTML += "<table class='table'>";
            dataPlanHTML += `<tr><th>S/N</th><th>Data Plan Title</th><th>Volume</th><th>Validity</th><th>Action</th></tr>`;
            for(let i = 0; i<data.data.length;i++){
                dataPlanHTML += `<tr><td>${((page-1)*data.per_page)+data.current_pageNew++}</td><td>${data.data[i].title}</td><td>${data.data[i].volume}</td><td>${data.data[i].validity}</td><td><span class ="data-delete-link" onclick = deleteDataPlan(${data.data[i].id},${data.current_page})>Delete</span></td></tr>`;
            }
            dataPlanHTML += "</table></div>";
            $('#display-data-plans').html(dataPlanHTML).removeClass('d-none');
            if(data.last_page>1){
                let pagesLink = "<div id='pages-links'>";
                for(let i = 1; i<=data.last_page;i++){
                    let linkClass = (i == page)? "active-page":"";
                    pagesLink += `<a href = "${url}?page=${i}" class = "${linkClass}" onclick=" displayDataPlans(${i});return false">${i}</a>`;
                    //alert("No of Pages totaled: "+ data.last_page);
                }
                pagesLink += "</div>";
               $('.table').after(pagesLink);
            }
        }
        else{
            alert("Hmm, try again!");
        }
    });
}displayDataPlans();
//handle form submission
$('#data-plan-form').submit(function(){
    //var dataVolume = $('[list = "volume"]');
    $('#notification-div').toggleClass('d-none');
    formatValues($('[list = "volume"]'));
    formatValues($('[list = "validity"]'));
    formatValues($('[list = "bonus_all"]'));
    formatValues($('[list = "bonus_new_sim"]'));
    //serialize form data and post to server
    $.post("/member/data-plan/create", $('#data-plan-form').serialize())
    .done(function(data){
        $('#notification-text').text("Success: Added data plan");
        $('#notification-div').removeClass('d-none').css({"border-color":"green"});
        displayDataPlans();
    })
    .fail(function(){
        $('#notification-text').text("Sorry, something went wrong. Pease check your input and try again.");
        $('#notification-div').removeClass('d-none');
    });
return false;
})
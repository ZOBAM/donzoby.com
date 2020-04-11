var dataPlanList;
var editedPlanID;
var url = "/member/data-plan";
var totalDataPlans;
var isEditing = false;
var formHeader = $('h3.text-center');
var formHeaderText = formHeader.text();
var submitBtn = $('[type = "submit"]');
var submitBtnPrevText = submitBtn.val();

function formatValues(dataType = false,elemResource = false){
    if(dataType == "validity"){
        let validity = elemResource;
        if(validity>24){
            return (validity/24)+' days'
        }else return validity+' hrs';
    }
    else if(dataType == 'volume'){
        //alert(elemResource);
        let volume = elemResource;
        if(volume>1000){
            return (volume/1024)+" GB";
        }
        else{
            //alert(isNaN(volume*1));
            return (volume == null)? '':volume+' MB';
        }
    }
    else{
        //alert(typeof(elemResource));
        var value = elemResource.val().toUpperCase().trim();
        if(value.lastIndexOf('GB') != -1){
            value = value.trim().replace('GB','')* 1 * 1024;
        }
        else if(value.lastIndexOf('MB') != -1){
            value = value.replace('MB','').trim() * 1;
        }
        else if(value.lastIndexOf('DAYS') != -1){
            value = value.trim().replace('DAYS','') * 1 * 24;
        }
        else if(value.lastIndexOf('HRS') != -1){
            value = value.trim().replace('HRS','') * 1;
        }
        elemResource.val(value);
    }
}//end formatValues
//formatValues(12);
function editDataPlan(id){
    isEditing = true;
    editedPlanID = id;
    let dataPlan = dataPlanList;
    //alert(dataPlan.length);
    for(let i = 0;i<dataPlan.length;i++){
        if(dataPlan[i].id == id){
            dataPlan = dataPlan[i];
            break;
        }
    }//end for loop
    //alert("about to edit "+dataPlan.title);
    formHeader.text('Editing "'+dataPlan.title+'"').css({"color":"blue"});
    submitBtn.val("Update Data Plan").removeClass('btn-success').css({"background-color":"blue","color":"white"});
    for(let field in dataPlan){
        if(field == "validity"){
            dataPlan[field] = formatValues('validity',dataPlan[field]);
        }
        if(field == "volume" || field == "bonus_all" || field == "bonus_new_sim"){
            dataPlan[field] = formatValues('volume',dataPlan[field]);
        }
        $('[name = '+field+']').val(dataPlan[field]);
    }
}//end edit function
//function for deleting specified data plan
function deleteDataPlan(id,page){
    let response = confirm("Are you sure you want to delete this data plan?\n Click OK to delete or cancel to go back");
    if(response){
        $.get(url+"/"+id, function(data, status){
            if (status == "success") {
            //data = JSON.parse(data);
                page = (data.data_plans_count%data.per_page == 1)? --page:page;
                displayDataPlans(page);
                alert(data.msg);
            }
            else {
                alert("An error occurred.");
            }
        })
    }
}
//fetch data plans form the db
function displayDataPlans(page = 1){
    if(page>=2){$('#notification-div').addClass('d-none');}
    if(!isEditing){
        submitBtn.val(submitBtnPrevText).addClass('btn-success').css({"background-color":""});
        formHeader.text(formHeaderText).css({"color":""});
        //alert("change heading");
    }
    $.get(url+"?page="+page, function(data, status){
        let displayDataPlan = $('#display-data-plans');
        if (status == "success") {
            dataPlanList = data.data;
            totalDataPlans = data.total;
            //alert(totalDataPlans+" data plans already uploaded.");
            var dataPlanHTML = "<div class = 'table-responsive col-md-10 offset-md-1 '>";
            dataPlanHTML += "<table class='table'>";
            dataPlanHTML += `<tr><th>S/N</th><th>Data Plan Title</th><th>Volume</th><th>Validity</th><th>Action</th></tr>`;
            for(let i = 0; i<data.data.length;i++){
                dataPlanHTML += `<tr><td>${((page-1)*data.per_page)+i+1}</td>`;
                dataPlanHTML += `<td><a href="/mobile-usage/service-providers/data-plans/${data.data[i].id}/${data.data[i].title}">${data.data[i].title}</a></td>`;
                dataPlanHTML += `<td>${formatValues('volume',data.data[i].volume)} for N${data.data[i].price}</td><td>${formatValues('validity',data.data[i].validity)}</td><td><span class ="data-delete-link" onclick = deleteDataPlan(${data.data[i].id},${data.current_page})>Delete</span> / <span class ="data-delete-link" onclick = editDataPlan(${data.data[i].id})>Edit</span></td></tr>`;
                dataPlanHTML += `<tr><td><em>How To Sub:</em></td><td colspan=4 class="how_to_sub">${data.data[i].how_to_sub}</td></tr>`;
            }
            dataPlanHTML += "</table></div>";
            displayDataPlan.html(dataPlanHTML).removeClass('d-none');
            //display pages navigation buttons
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
    let url = "/member/data-plan/create";
    if(isEditing){
        //alert("Editing");
       url = "/member/data-plan/edit/"+editedPlanID;
    }
    let notificationDiv = $('#notification-div');
    let notificationText = $('#notification-text');
    //var dataVolume = $('[list = "volume"]');
    notificationDiv.toggleClass('d-none');
    formatValues(false,$('[list = "volume"]'));
    formatValues(false,$('[list = "validity"]'));
    formatValues(false,$('[list = "bonus_all"]'));
    formatValues(false,$('[list = "bonus_new_sim"]'));
    //serialize form data and post to server
    $.post(url, $('#data-plan-form').serialize())
    .done(function(data){
        notificationText.text(data);
        notificationDiv.removeClass('d-none').addClass('bg-success');
        notificationDiv.children('div').css({'border':'4px double white','color':'white','font-weight':'bolder'});
        isEditing = false;
        displayDataPlans();
        notificationText[0].scrollIntoView(false);
    })
    .fail(function(){
        notificationText.text("Sorry, something went wrong. Pease check your input and try again.");
        notificationText[0].scrollIntoView(false);
        notificationDiv.removeClass('d-none');
    });
return false;
})

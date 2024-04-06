<x-user-layout>
    <div class="user-dp-container tw-flex tw-flex-col tw-justify-center tw-items-center">
        <img src="{{ asset('images/profile/zobam_gig.png') }}" alt="">
        <span>Joined 21 Sept. 2018</span>
    </div>
    <div class="user-details tw-mt-10">
        <div class="table-responsive">
            <table class="table table-borderless ">
                <tr>
                    <td><span>First Name:</span></td>
                    <td>John</td>
                </tr>
                <tr>
                    <td><span>Last Name:</span></td>
                    <td>Doe</td>
                </tr>
                <tr>
                    <td><span>Phone No:</span></td>
                    <td>2347012121212</td>
                </tr>
                <tr>
                    <td><span>Email:</span></td>
                    <td>doejohn@gmail.com</td>
                </tr>
                <tr>
                    <td><span>Country:</span></td>
                    <td>Nigeria</td>
                </tr>
                <tr>
                    <td><span>Comment Count:</span></td>
                    <td class="comment">23 comments</td>
                </tr>
            </table>
        </div>
        <button class="btn btn-primary tw-font-bold tw-mt-10">Edit profile</button>
    </div>
</x-user-layout>

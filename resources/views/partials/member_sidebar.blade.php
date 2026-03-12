<div class="col-md-3">
    <div class="profile-box">
        @if($user->latestProfileImage)
            <img src="{{ asset('storage/' . $user->latestProfileImage->image) }}" class="img-fluid">
        @else
            @php
                $image_list = ($user->gender == 'Female') ? 'female.png' : 'men.png';
            @endphp
            <img src="{{ asset('assets/images/' . $image_list) }}" class="img-fluid">
        @endif
        
        <h4><b>{{ $user->name }}</b></h4>
        <div class="text-center">
            <a href="#" class="btn btn-freeplan" style="color:#fff;">{{ $user->plan ?? 'FREE' }}&nbsp;PLAN</a>
        </div>
        
        <ul class="list-unstyled mt-3">
            <li><i class="fa fa-pencil"></i> <a href="{{ route('profile.edit') }}">Profile</a></li>
            <li><i class="fa fa-search"></i> <a href="{{ route('search.id') }}">ID Search</a></li>
            <li><i class="fa fa-search-plus"></i> <a href="{{ route('search.advanced') }}">Advanced Search</a></li>
            <li><i class="fa fa-user-circle-o"></i> <a href="#">Set Preference</a></li>
            <li><i class="fa fa-user-circle-o"></i> <a href="#">Viewed Contacts</a></li>
        </ul>
        
        <p style="font-size: 14px;font-weight: 600;">Your Balance Count&nbsp;<span style="color:red;">0</span>&nbsp;Out of <span style="color:#001fff;">&nbsp;0</span></p>
    </div>
</div>

<div id="sidepanel">
    <div id="profile">
        <div class="wrap">
            <img id="profile-img" src="{{ asset('image/avatar.jpg') }}" class="online" alt="" />
            <p>{{ Auth::user()->name }}</p>
            <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
            <div id="status-options">
                <ul>
                    <li id="status-online" class="active"><span class="status-circle"></span>
                        <p>Online</p>
                    </li>
                    <li id="status-away"><span class="status-circle"></span>
                        <p>Away</p>
                    </li>
                    <li id="status-busy"><span class="status-circle"></span>
                        <p>Busy</p>
                    </li>
                    <li id="status-offline"><span class="status-circle"></span>
                        <p>Offline</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <hr>
    <div id="contacts">
        <ul>
            @forelse ($users as $user)
                <li class="contact" data-id="{{ $user->id }}">
                    <div class="wrap">
                        <span class="contact-status offline"></span>
                        <img src="{{ asset('image/avatar.jpg') }}" alt="{{ $user->name }}" />  
                    </div>
                    <div class="meta">
                        <div class="name">{{ $user->name }}</div>
                        <div class="preview">{{ $user->email }}</div>
                    </div>
                </li>
            @empty
                <div class="text-center">
                    <p>No user found</p>
                </div>
            @endforelse
        </ul>
    </div>
    <div class="text-center">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</div>



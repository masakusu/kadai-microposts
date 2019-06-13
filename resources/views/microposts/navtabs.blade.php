<ul class="nav nav-tabs nav-justified mb-3">
    <li class="nav-item"><a href="{{ route('users.show', ['id' => $user->id]) }}" class="nav-link {{ Request::is('micropost/' . $user->id) ? 'active' : '' }}">TimeLine <span class="badge badge-secondary">{{ $count_microposts }}</span></a></li>
    <li class="nav-item"><a href="{{ route('users.navtabs', ['id' => $micropost->id]) }}" class="nav-link {{ Request::is('microposts/*/favorites') ? 'active' : '' }}">Favorites <span class="badge badge-secondary">{{ $count_favorites }}</span></a></li>
</ul>
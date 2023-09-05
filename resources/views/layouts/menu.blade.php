<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>

    <a href="{{ route('notification.store') }}" class="nav-link {{ Request::is('notification') ? 'active' : '' }}">
        <i class='far fa-comment'></i>
        <p>Mensajes</p>
    </a>

    @php
        $menu_anterior = 0;
    @endphp
    @for ( $i = 0; $i < sizeof($gbl_menus); $i++ )
        @if ( !($menu_anterior == $gbl_menus[$i]->menu_id) )
            <li class="side-menus">
                <a href="#" class="nav-link">
                    <i class='fa fa-list'></i>
                    <span>
                            @php
                                echo $gbl_menus[$i]->name3;
                            @endphp
                    </span>
                    <i class="right fas fa-angle-left"></i>
                </a>

                @for ($j = 0; $j < sizeof($gbl_menus); $j++)
                    @if ($gbl_menus[$i]->menu_id == $gbl_menus[$j]->menu_id)
                        <li class="side-menus">
                            <a href="{{$gbl_menus[$j]->url }}" class="nav-link pl-2">
                                <i class='fa fa-angle-right'></i>
                            <span>
                                    @php
                                        echo $gbl_menus[$j]->name2;
                                    @endphp
                            </span>
                            </a>
                        </li>
                    @endif

                @endfor

                @php
                    $menu_anterior = $gbl_menus[$i]->menu_id;
                @endphp
            </li>
        @endif
    @endfor
</li>

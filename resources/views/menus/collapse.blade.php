<a data-toggle="collapse"
    href="#submenuCollapse{{$menu->id}}">
    {{$menu->name}}
</a>

<div class="collapse" id="submenuCollapse{{$menu->id}}">
    <div class="flex">
        <div class="card card-body">
            <h6>Submenus:</h6>
            @foreach ( $menu->submenu as $item )
            <li>
                {{$item->name}}
            </li>
            @endforeach
        </div>
    </div>
</div>

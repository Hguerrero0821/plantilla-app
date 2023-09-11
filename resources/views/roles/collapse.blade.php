<a data-toggle="collapse"
    href="#collapseExample{{$rol->id}}"
    aria-expanded="false"
    aria-controls="collapseExample {{$rol->id}}">
    {{$rol->name}}
</a>

<div class="collapse" id="collapseExample{{$rol->id}}">

    <div class="card card-body">
        <h6>
            <b>Usuarios</b>
        </h6>
            @foreach ( $rol->rolesUsuarios as $item )
                <li>
                    {{ $item->usuario->name }}
                </li>
            @endforeach ()

        </div>

        <div class="card card-body">
            <table>
                <thead>
                    <th>
                        <b>Submenus</b>
                    </th>
                    <th>
                        <b>Permisos</b>
                    </th>

                </thead>

                <tbody>

                    @foreach ( $rol->rolesSubmenus as $item )

                    <tr>
                        <td>
                            <li>
                                {{ $item->submenus->name }}

                            </li>
                        </td>

                        <td>
                            <b>{{ $item->create ? 'Crear' : ''}}</b>
                            <b>{{ $item->edit ? '  Editar' : ''}} </b>
                            <b>{{ $item->delete ? ' Eliminar' : ''}}</b>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>

        </div>

</div>

<template>
    <table class="table">
        <thead>
            <th>Nombre del submenu</th>
            <th>Nombre del url</th>
            <th>
                <button class="btn btn-info" type="button" @click.prevent="addRow">
                    + Agregar
                </button>
            </th>
        </thead>
        <tbody>
            <tr v-for="(row, index) in cantidadRegistro">
                <td>
                    <input type="text" class="form-control" name="submenu_name[]"
                    v-model="row.name" required>

                    <input v-if="row.id"
                    v-model="row.id"
                    type="hidden"
                    name="submenu_id[]"/>
                </td>
                <td>
                    <input type="text" class="form-control" name="url_name[]"
                    v-model="row.url" required>
                </td>
                <td>
                    <button type="button" class="btn btn-danger"
                    v-on:click="deleteRow" @click.prevent="deleteRow(index)">
                        - Eliminar
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

</template>

<script>
    export default {
        props: {
            data: {
                type: Array,
                required: true
            }
        },

        data() {
            return {
                'cantidadRegistro': this.data ?? [
                    {name: '', url:''}
                ]
            }
        },

        methods: {
            addRow() {
                this.cantidadRegistro.push({title:'', url:''});
            },

            deleteRow(index) {
                this.cantidadRegistro = this.cantidadRegistro.filter(( r, i ) => i!= index );
            }
        },
    }
</script>

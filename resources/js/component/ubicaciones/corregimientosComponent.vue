<template>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th>Nombre del distrito</th>
          <th>
            <button
              type="button"
              class="btn btn-info"
              @click.prevent="addRow">
              + Agregar Distrito
            </button>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(row, index) in dataRows" :key="index">
          <td>
            <input
              type="text"
              class="form-control"
              :name="`distrito_name[${index}]`"
              v-model="row.distrito_name"
              required/>
          </td>
          <td>
            <button
              type="button"
              class="btn btn-danger"
              @click.prevent="deleteRow(index)">
              - Eliminar Distrito
            </button>
          </td>
          <td>
            <div v-for="(corregimiento, corIndex) in row.corregimientos" :key="corIndex">
                <td>
                    <input
                    type="text"
                    class="form-control"
                    :name="`corregimiento_name[${index}][${corIndex}]`"
                    :value="corregimiento"
                    @input="updateCorregimiento(index, corIndex, $event.target.value)"
                    required/>
                </td>

                <td>
                    <button
                    type="button"
                    class="btn btn-info"
                    @click.prevent="addCorregimiento(index)">
                    + Agregar Corregimiento
                    </button>
                </td>

                <td>
                    <button
                        type="button"
                        class="btn btn-danger"
                        @click.prevent="deleteCorregimiento(index, corIndex)">
                        - Eliminar Corregimiento
                    </button>
                </td>


            </div>

          </td>

        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dataRows: [
        { distrito_name: '', corregimientos: [''] }
      ]
    };
  },
  methods: {
    addRow() {
      this.dataRows.push({ distrito_name: '', corregimientos: [''] });
    },
    addCorregimiento(index) {
      this.dataRows[index].corregimientos.push('');
    },
    updateCorregimiento(distritoIndex, corregimientoIndex, value) {
      this.dataRows[distritoIndex].corregimientos[corregimientoIndex] = value;
    },
    deleteRow(index) {
      this.dataRows.splice(index, 1);
    },
    deleteCorregimiento(distritoIndex, corregimientoIndex) {
      this.dataRows[distritoIndex].corregimientos.splice(corregimientoIndex, 1);
    }
  }
};
</script>

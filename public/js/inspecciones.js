$(document).ready(function(){

    // Se crea una variable con la ruta raíz del proyecto
    var url = "http://localhost/fiscalizacion/public";

    $('.addRow').on('click', function(){
        addRow();
    });

    function addRow(){
        var tr =
                '<tr>' +
                    '<td><input type="number" id="cantidad" name="cantidad[]" class="form-control" required></td>' +
                    '<td><a href="#" class="btn btn-danger remove"><i class="fas fa-trash-alt"></i></a></td>' +
                '</tr>';
        $('tbody').append(tr);
    }

});
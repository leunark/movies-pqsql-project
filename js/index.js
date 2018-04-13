$(document).ready(function() {

    // Initialize Mode Selection
    $('select').material_select();

    $('#buttonSearch').click(function(event){
        event.preventDefault();
        var _mode = $('#selectMode').val();
        var _term = $('#inputSearch').val();
        $.get( "../php/dbsearch.php", { mode: _mode, term: _term } )
            .done(function(result){
                var tableContent = $('table#tableData > tbody');
                tableContent.empty();
                console.log(result);
                var obj = JSON.parse(result);
                var data = obj['data'];
                var color;
                for(var key in data){    
                    var type = data[key];
                    if(key=='actors') color = 'blue';
                    else if(key=='movies') color = 'green';
                    else color = 'red';
                    for(var keyProp in type){  
                        tableContent.append(
                            '<tr>'+
                                '<td>'+ keyProp +'</td>'+
                                '<td style="color:'+color+';">'+ type[keyProp] +'</td>'+
                            '</tr>'
                        );

                    }
                }

                
        });
    });

});


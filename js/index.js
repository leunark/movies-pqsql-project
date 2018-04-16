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
                
                var obj = JSON.parse(result);
                var data = obj['data'];
                console.log(data);

                var color;
                for(var key in data){    
                    var type = data[key];
                    if(key=='actors') color = 'blue';
                    else if(key=='movies') color = 'green';
                    else color = 'red';

                    if(_mode == 0){
                        // fuzzy search 
                        var options = {
                            threshold: 0.2,
                            location: 0,
                            distance: 100,
                            maxPatternLength: 32,
                            minMatchCharLength: 1,
                            keys: [
                              "value"
                            ]
                        };
                        var fuse = new Fuse(type, options);
                        var res = fuse.search(_term);
                    
                        for(var keyProp in res){  
                            tableContent.append(
                                '<tr>'+
                                    '<td>'+ res[keyProp]['id'] +'</td>'+
                                    '<td style="color:'+color+';">'+ res[keyProp]['value'] +'</td>'+
                                '</tr>'
                            );
                        }
                    }else{
                        for(var keyProp in type){  
                            tableContent.append(
                                '<tr>'+
                                    '<td>'+ keyProp +'</td>'+
                                    '<td style="color:'+color+';">'+ type[keyProp] +'</td>'+
                                '</tr>'
                            );
                        }
                    }
                }
                    
        });
    });

});




$('document').ready(function(){


    $('select[name="gradeID"]').change(function(){
       
        $.ajax({

            method : 'get',
            url : 'classrooms/get',
            data : {gradeID:$(this).val()},

            success:function(data,status,xhr) {
                element = $('.classroomID');
                element.html('');

                $.each(data,function(key,value){
                    
                    element.append(
                        '<option value="'+key+'">'+value+'</option>'
                    )
                });
                
            },
            error: function(xhr,status,error) {
                alert(error);
            }
        
        });

    })

});


$('document').ready(function(){


    $('select[name="subjectID"]').change(function(){
      
        $.ajax({

            method : 'get',
            url : 'teacher/get',
            data : {subjectID:$(this).val()},
            success:function(data,status,xhr) {
                
                element = $('.teacherID');
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

    
    $('select[name="gradeID"]').change(function(){
        isQuizz = $(this).attr('quizz');

        if(isQuizz != 'true') {

            $.ajax({
            
                method : 'get',
                url : 'teacher/get/byGrade',
                data : {gradeID:$(this).val()},
                success:function(data,status,xhr) {
                    console.log(data);
                    element = $('.teacherID');
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

        }
        
    })


});
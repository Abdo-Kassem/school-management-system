

$('document').ready(function(){


    $('select[name="type"]').change(function(){
      
        $.ajax({

            method : 'get',
            url : $(this).attr('url'),
            data : {studentID:$('input[name="studentID"]').val(),type:$(this).val()},
            success:function(data,status,xhr) {
                credit = $('input[name="credit"]');
                feesID = $('input[name="studyFeesID"]');
                
                credit.val(data.value);
                feesID.val(data.id);
                
            },
            error: function(xhr,status,error) {
                alert(error);
            }
        
        });

    })

    

});
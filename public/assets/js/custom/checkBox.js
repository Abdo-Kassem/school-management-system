
$('document').ready(function(){

    modalButton = $('.rollback');
    elements = Array.prototype.slice.call($('.promotion_checked'));

    $('.check_all').click(function(){
       
        if($('.check_all').prop('checked')) {
            elements.forEach(function(item){
                item.checked = true;
            });
            modalButton.prop('disabled',false);
        }else {
            
            elements.forEach(function(item){
                item.checked = false;
            });
            modalButton.prop('disabled',true);
        }
    }); 

    $('.rollback').click(function() {

        ids = '';
        count = 0;

        elements.forEach(function(item){
            if(item.checked) {
                ids = ids + item.value + ',';
                count++;
            }
        });

        if(count === 0)
            $(this).prop('disabled',true);

       $('input[name="promotionIDs"]').val(ids);
    });

});
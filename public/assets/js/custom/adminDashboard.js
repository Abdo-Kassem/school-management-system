function show(object) {
    //id of nav link is the same belong_to custom attribute
    navItemID = object.id; 

    element = document.querySelector('[belong_to = '+ navItemID +']')
    hidden(element);

}

function hidden(element)
{
    elements = $('.custom-hide');
    
    length = elements.length;
    
    for(i=0;i<length;i++) {

        if(elements[i].id == element.id) {
            console.log(element);
            element.style.display = 'block';
            element.style.opacity = '1';
            continue;
        }
        elements[i].style.display = 'none';
    }
}
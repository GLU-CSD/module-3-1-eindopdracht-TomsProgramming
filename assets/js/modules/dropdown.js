export function open(element){
    if(!element){
        return;
    }

    const dropdownContent = element.parentElement.querySelector('.dropdownContent');
    const buttonIcon = element.querySelector('i');
    if(dropdownContent){
        dropdownContent.classList.toggle('show');
        buttonIcon.classList.toggle('fa-caret-down');
        buttonIcon.classList.toggle('fa-caret-up');
    }
}
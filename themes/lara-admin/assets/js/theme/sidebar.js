let sidebarSwitch=()=>{
    if(document.body.classList.contains('is-sidebar-mini')){
        document.body.classList.remove('is-sidebar-mini')
    }else{
        document.body.classList.add('is-sidebar-mini');
    }
}
window.sidebarSwitch=sidebarSwitch;
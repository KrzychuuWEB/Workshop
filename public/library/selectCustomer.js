$('#car_add_customer option').each(function(){
    if(this.value == customerID) {
        $(this).attr("selected", "selected");
    }
});
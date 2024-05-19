


function get_bookings(search=''){
    let xhr=new XMLHttpRequest();
    xhr.open("POST","ajax/refund_bookings.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload=function(){
        document.getElementById('table-data').innerHTML=this.responseText;
    }

    xhr.send('get_bookings&search='+search);
}


function refund_bookings(id){
    if(confirm("Are you sure,you want to Refund this booking ?")){

        let data= new FormData();
        data.append('booking_id',id);
        data.append('refund_bookings','');

        let xhr=new XMLHttpRequest();
        xhr.open("POST","ajax/refund_bookings.php",true);

        xhr.onload=function(){

            if(this.responseText==1){
                alert('success','Refunded.');
                get_bookings();
            }
            else{
                alert('error','Error Occured');
            }
        
        }
        xhr.send(data);
    }
}


         
window.onload=function(){
    get_bookings();
}

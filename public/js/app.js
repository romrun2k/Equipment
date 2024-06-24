let alert_swal = (type, text) => {
    Swal.fire({
        title: text,
        icon: type
    });

}

let formatPrice = (price) => {
     // Convert price to a number if it's not already
     price = Number(price);
     if (isNaN(price)) {
         return 'N/A'; // or any default value if price is not a number
     }
     return price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

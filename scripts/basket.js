//[1600, 2050] - цена
//[1, 3] - кол-во
function basketTotalSumm() {
    //console.log("basketTotalSumm");
    let summa = 0;

    for (const key in prices) {

        //достаем текст
        const price = prices [key].innerHTML;

        // значение инпута
        const count = counts [key].value;

        summa += (+price) * (+count)
    }
    basketSumm.innerHTML = summa
}
const prices = [...document.getElementsByClassName("price")];
const counts = [...document.getElementsByClassName("count")];

// console.log(prices);
// console.log(counts);

for (const input of counts) {
    console.log(input);
    input.addEventListener("input", () => {
        basketTotalSumm();
    
});
}
basketTotalSumm();

//модальное окно заказа
placeOrder.addEventListener ("click", (event) => {
    event.preventDefault();

    modalOrder.style.display = "block"
});

modalOrder.addEventListener ("click", (event) => {
    event.preventDefault();

    modalOrder.style.display = "none"

});

modalOrderForm.addEventListener("click", (event) => {
    event.stopPropagation();
});



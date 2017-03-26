let offer_text = document.getElementById("user_agreement");
let i = 0;

function show_agreement() {
    if (i == 0) {
        user_agreement.style.display = 'block';
        i++;
    } else {
        user_agreement.style.display = 'none';
        i--;
    }
}

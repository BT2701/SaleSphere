/*them moi*/
var star=0;
function rateStar(clickedStar) {
    star=clickedStar;
    // Cập nhật giá trị cho trường ẩn txtselectedStar
    document.getElementById("selectedStar").value = star;
    const stars = document.querySelectorAll('.star-button');
    for (let i = 0; i < stars.length; i++) {
        if (i < clickedStar) {
            stars[i].classList.add('clicked');
        } else {
            stars[i].classList.remove('clicked');
        }
    }

}

function checkInfoEvalute(){
    var reviewText = document.getElementById("reviewText").value;
    if(star==0){
        alert("Vui lòng chọn số sao");
        return false;
    }
    if(reviewText.length > 200){
        alert("Đánh giá không được vượt quá 200 ký tự");
        return false;
    }

    return true;  
}
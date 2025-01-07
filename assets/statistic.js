changeStatisticCategory();
function changeStatisticCategory(){
    let choice = document.getElementById('stat_categorie').value;
    let categoryList = document.querySelectorAll('.category');
    let selectedCategory = document.querySelector(`.${choice}`);
    for(i = 0; i < categoryList.length; i++){
        categoryList[i].style.display = 'none';
    }
    selectedCategory.style.display = 'flex';
}
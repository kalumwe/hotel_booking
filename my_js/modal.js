// item_id = "";

function openModal(item_id) {
    //var modal = document.getElementById("deleteModal");
    //modal.style.display = "block";

    //var item_id = document.getElementById("open").value;
    //item = item_id;

    var deleteUrl = "./admin/delete_room_cat.php?id=" + item_id;
    document.getElementById("delete").setAttribute("href", deleteUrl);
    //document.getElementById("delform").setAttribute("action", deleteUrl);
    console.log(deleteUrl);


}

function openModal2(item_id) {
    //var modal = document.getElementById("deleteModal");
    //modal.style.display = "block";

    //var item_id = document.getElementById("open").value;
    //item = item_id;

    var deleteUrl = "remove_room.php?id=" + item_id;
    document.getElementById("delete").setAttribute("href", deleteUrl);
    //document.getElementById("delform").setAttribute("action", deleteUrl);
    console.log(deleteUrl);


}

function openModal3(item_id) {
    //var modal = document.getElementById("deleteModal");
    //modal.style.display = "block";

    //var item_id = document.getElementById("open").value;
    //item = item_id;

    var deleteUrl = "delete_manager.php?id=" + item_id;
    document.getElementById("delete").setAttribute("href", deleteUrl);
    //document.getElementById("delform").setAttribute("action", deleteUrl);
    console.log(deleteUrl);


}

function deleteItem(deleteUrl) {
    Window.location.href = deleteUrl;
}
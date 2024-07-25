<script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="assets/js/plugin/jsvectormap/world.js"></script>

  <!-- Sweet Alert -->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="assets/js/setting-demo.js"></script>
  <script src="assets/js/demo.js"></script>
  <script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#177dff",
      fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#f3545d",
      fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#ffa534",
      fillColor: "rgba(255, 165, 52, .14)",
    });
  </script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var editRoomModal = document.getElementById('EditRoomModal');
    editRoomModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var roomID = button.getAttribute('data-id');
        var name = button.getAttribute('data-room-name');
        var type = button.getAttribute('data-room-type');
        var capacity = button.getAttribute('data-capacity');
        var price = button.getAttribute('data-price');
        var description = button.getAttribute('data-description');
        var numberBed = button.getAttribute('data-number-bed');
        var typeBed = button.getAttribute('data-type-bed');
        var quantity = button.getAttribute('data-quantity');
        var disponibility = button.getAttribute('data-disponibility') === '1';
        var wifi = button.getAttribute('data-wifi') === '1';
        var tv = button.getAttribute('data-tv') === '1';
        var climatiseur = button.getAttribute('data-climatiseur') === '1';
        var freeDrink = button.getAttribute('data-free-drink') === '1';

        var modal = editRoomModal;
        modal.querySelector('#editRoomID').value = roomID;
        modal.querySelector('#editRoomName').value = name;
        modal.querySelector('#editType').value = type;
        modal.querySelector('#editCapacity').value = capacity;
        modal.querySelector('#editPrice').value = price;
        modal.querySelector('#editDescription').value = description;
        modal.querySelector('#editNumberBed').value = numberBed;
        modal.querySelector('#editBedType').value = typeBed;
        modal.querySelector('#editquantity').value = quantity;
        modal.querySelector('#disponibilityCheck').checked = disponibility;
        modal.querySelector('#wifiCheck').checked = wifi;
        modal.querySelector('#tvCheck').checked = tv;
        modal.querySelector('#climatiseurCheck').checked = climatiseur;
        modal.querySelector('#freeDrinkCheck').checked = freeDrink;
    });
});


</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var showModal = document.getElementById('show');
    showModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        // Extract info from data-* attributes
        var roomName = button.getAttribute('data-room-name');
        var roomType = button.getAttribute('data-room-type');
        var roomCapacity = button.getAttribute('data-capacity');
        var roomPrice = button.getAttribute('data-price');
        var roomDescription = button.getAttribute('data-description');
        var roomNumberBed = button.getAttribute('data-number-bed');
        var roomBedType = button.getAttribute('data-type-bed');
        var roomQuantity = button.getAttribute('data-quantity');
        
        // Update the modal's content.
        var modalTitle = showModal.querySelector('.modal-title');
        var modalBody = showModal.querySelector('.room-info');
        modalTitle.textContent = roomName;
        modalBody.querySelector('#roomName').textContent = roomName;
        modalBody.querySelector('#roomType').textContent = roomType;
        modalBody.querySelector('#roomCapacity').textContent = roomCapacity;
        modalBody.querySelector('#roomPrice').textContent = roomPrice;
        modalBody.querySelector('#roomDescription').textContent = roomDescription;
        modalBody.querySelector('#roomNumberBed').textContent = roomNumberBed;
        modalBody.querySelector('#roomBedType').textContent = roomBedType;
        modalBody.querySelector('#roomquantity').textContent = roomQuantity;

        // Optional: Set image src if available
        var roomImage = button.getAttribute('data-room-image');
        if(roomImage) {
            modalBody.querySelector('#roomImage').src =  '../img/rooms/' + roomImage;
        }
    });
});



</script>
<script>
function openModal2(photo, name, type, capacity, price, description, numberBed, bedType, quantity) {
    document.getElementById('roomImage').src = '../img/rooms/' + photo;
    document.getElementById('roomName').innerText = name;
    document.getElementById('roomType').innerText = type;
    document.getElementById('roomCapacity').innerText = capacity;
    document.getElementById('roomPrice').innerText = price;
    document.getElementById('roomDescription').innerText = description;
    document.getElementById('roomNumberBed').innerText = numberBed;
    document.getElementById('roomBedType').innerText = bedType;
    document.getElementById('roomquantity').innerText = quantity;

    
    // Show the modal
    var modal = document.getElementById('show');
    modal.style.display = 'block';
}

function closeModal2() {
    var modal = document.getElementById('show');
    modal.style.display = 'none';
}
</script>


<script>
document.addEventListener('DOMContentLoaded', (event) => {
    var editModal = document.getElementById('Editstaff');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var staffId = button.getAttribute('data-id2');
        var staffName = button.getAttribute('data-name2');
        var staffEmail = button.getAttribute('data-email2');
        var staffPhone = button.getAttribute('data-phone2');
        var staffPassword = button.getAttribute('data-password2');
        var staffPosition = button.getAttribute('data-position2');

        // Update the modal's content.
        var modalStaffID = editModal.querySelector('#editstaffId');
        var modalStaffName = editModal.querySelector('#editname');
        var modalStaffEmail = editModal.querySelector('#editemail');
        var modalStaffPhone = editModal.querySelector('#editphone');
        var modalStaffPassword = editModal.querySelector('#editpassword');
        var modalStaffPosition = editModal.querySelector('#editposition');

        modalStaffID.value = staffId;
        modalStaffName.value = staffName;
        modalStaffEmail.value = staffEmail;
        modalStaffPhone.value = staffPhone;
        modalStaffPassword.value = staffPassword;
        modalStaffPosition.value = staffPosition;
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    var editModal = document.getElementById('Editguests');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var guestId = button.getAttribute('data-id');
        var guestName = button.getAttribute('data-name');
        var guestEmail = button.getAttribute('data-email');
        var guestPhone = button.getAttribute('data-phone');
        var guestAddress = button.getAttribute('data-address');
        var guestNationality = button.getAttribute('data-nationality');
        var guestPassportNumber = button.getAttribute('data-passport');
        var guestDateOfBirth = button.getAttribute('data-dateofbirth');
        var guestGender = button.getAttribute('data-gender');

        // Update the modal's content.
        var modalGuestID = editModal.querySelector('#editguestId');
        var modalGuestName = editModal.querySelector('#editName');
        var modalGuestEmail = editModal.querySelector('#editEmail');
        var modalGuestPhone = editModal.querySelector('#editPhone');
        var modalGuestAddress = editModal.querySelector('#editAddress');
        var modalGuestNationality = editModal.querySelector('#editNationality');
        var modalGuestPassportNumber = editModal.querySelector('#editPassportNumber');
        var modalGuestDateOfBirth = editModal.querySelector('#editDateOfBirth');
        var modalGuestGender = editModal.querySelector('#editGender');

        modalGuestID.value = guestId;
        modalGuestName.value = guestName;
        modalGuestEmail.value = guestEmail;
        modalGuestPhone.value = guestPhone;
        modalGuestAddress.value = guestAddress;
        modalGuestNationality.value = guestNationality;
        modalGuestPassportNumber.value = guestPassportNumber;
        modalGuestDateOfBirth.value = guestDateOfBirth;
        modalGuestGender.value = guestGender;
    });
});

</script>


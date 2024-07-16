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
        function openModal() {
            document.getElementById('addRoomModal').style.display = 'block';
            document.getElementById('mainContent').classList.add('modal-backdrop-blur'); // Apply blur to main content
        }

        function closeModal() {
            document.getElementById('addRoomModal').style.display = 'none';
            document.getElementById('mainContent').classList.remove('modal-backdrop-blur'); // Remove blur from main content
        }
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
function openEditRoomModal(roomID, photo, name, type, capacity, price, description, numberBed, bedType, quantity) {
    document.getElementById('editRoomID').value = roomID;
    document.getElementById('editName').value = name;
    document.getElementById('editType').value = type;
    document.getElementById('editCapacity').value = capacity;
    document.getElementById('editPrice').value = price;
    document.getElementById('editDescription').value = description;
    document.getElementById('editNumberBed').value = numberBed;
    document.getElementById('editBedType').value = bedType;
    document.getElementById('editquantity').value = quantity;

    var modal = document.getElementById('edit');
    modal.style.display = 'block';
}

function closeEditModal() {
    var modal = document.getElementById('edit');
    modal.style.display = 'none';
}

// Close the modal when the user clicks outside of it
window.onclick = function(event) {
    var modal = document.getElementById('edit');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

</script>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    var editModal = document.getElementById('EditModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var serviceId = button.getAttribute('data-id');
        var serviceName = button.getAttribute('data-name');
        var serviceType = button.getAttribute('data-type');
        var serviceDescription = button.getAttribute('data-description');
        var serviceAmount = button.getAttribute('data-amount');

        // Update the modal's content.
        var modalServiceID = editModal.querySelector('#editServiceID');
        var modalServiceName = editModal.querySelector('#editName');
        var modalServiceType = editModal.querySelector('#editType');
        var modalServiceDescription = editModal.querySelector('#editDescription');
        var modalServiceAmount = editModal.querySelector('#editAmount');

        modalServiceID.value = serviceId;
        modalServiceName.value = serviceName;
        modalServiceType.value = serviceType;
        modalServiceDescription.value = serviceDescription;
        modalServiceAmount.value = serviceAmount;
    });
});
</script>
<script>
    function confirmDelete(serviceId) {
        if (confirm("Are you sure you want to delete this service?")) {
            // Submit the form with the service ID to delete_service.php
            var form = document.createElement('form');
            form.method = 'post';
            form.action = './traitement/editservice.php'; // Adjust the action URL as needed

            var serviceIdField = document.createElement('input');
            serviceIdField.type = 'hidden';
            serviceIdField.name = 'service_id';
            serviceIdField.value = serviceId;

            var deleteField = document.createElement('input');
            deleteField.type = 'hidden';
            deleteField.name = 'delete_service';
            deleteField.value = '1';

            form.appendChild(serviceIdField);
            form.appendChild(deleteField);

            document.body.appendChild(form);
            form.submit();
        }
    }
    </script>
<script src="assets/js/core/jquery-3.7.1.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


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


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="dailySalesChart"></canvas>
</script>
<script>
    $(document).ready(function() {
        let monthlyGuests = <?php echo $monthlyGuests_json; ?>;

        $("#lineChart").sparkline(monthlyGuests, {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });
    });
</script>
<script>
    let lineChart = document.getElementById('statisticsChart').getContext('2d');

    let myLineChart = new Chart(lineChart, {
        type: "line",
        data: {
            labels: <?php echo $labels_json; ?>,
            datasets: [{
                label: "Total Booking Amount monthly",
                borderColor: "#1d7af3",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#1d7af3",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: "transparent",
                fill: true,
                borderWidth: 2,
                data: <?php echo $data_json; ?>,
            }]
        },
        options: {
            maintainAspectRatio: !1,
            legend: {
                display: !1
            },
            animation: {
                easing: "easeInOutBack"
            },
            scales: {
                yAxes: [{
                    display: !1,
                    ticks: {
                        position: "bottom",
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold",
                        beginAtZero: !0,
                        maxTicksLimit: 10,
                        padding: 0
                    },
                    gridLines: {
                        drawTicks: !1,
                        display: !1
                    }
                }],
                xAxes: [{
                    display: !1,
                    gridLines: {
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: -20,
                        fontColor: "rgba(255,255,255,0.2)",
                        fontStyle: "bold"
                    }
                }]
            }
        }
    });
</script>
<script>
    let pieChart = document.getElementById('dailySalesChart').getContext('2d');

    function getRandomColor() {
        return '#' + Math.floor(Math.random() * 16777215).toString(16);
    }

    let roomNames = <?php echo $roomNames_json; ?>;
    let roomQuantities = <?php echo $quantities_json; ?>;


    let roomColors = roomNames.map(() => getRandomColor());

    let myPieChart = new Chart(pieChart, {
        type: "pie",
        data: {
            datasets: [{
                data: roomQuantities,
                backgroundColor: roomColors,
                borderWidth: 0,
            }, ],
            labels: roomNames,
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: "bottom",
                labels: {
                    fontColor: "rgb(250, 250, 250)",
                    fontSize: 11,
                    usePointStyle: true,
                    padding: 20,
                },
            },
            pieceLabel: {
                render: "percentage",
                fontColor: "white",
                fontSize: 14,
            },
            tooltips: false,
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 20,
                },
            },
        },
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let editRoomModal = document.getElementById('EditRoomModal');
        editRoomModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget;
            let roomID = button.getAttribute('data-id');
            let name = button.getAttribute('data-room-name');
            let type = button.getAttribute('data-room-type');
            let capacity = button.getAttribute('data-capacity');
            let price = button.getAttribute('data-price');
            let description = button.getAttribute('data-description');
            let numberBed = button.getAttribute('data-number-bed');
            let typeBed = button.getAttribute('data-type-bed');
            let quantity = button.getAttribute('data-quantity');
            let disponibility = button.getAttribute('data-disponibility') === '1';
            let wifi = button.getAttribute('data-wifi') === '1';
            let tv = button.getAttribute('data-tv') === '1';
            let climatiseur = button.getAttribute('data-climatiseur') === '1';
            let freeDrink = button.getAttribute('data-free-drink') === '1';

            let modal = editRoomModal;
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
        let showModal = document.getElementById('show');
        showModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget;

            // Extract info from data-* attributes
            let roomName = button.getAttribute('data-room-name');
            let roomType = button.getAttribute('data-room-type');
            let roomCapacity = button.getAttribute('data-capacity');
            let roomPrice = button.getAttribute('data-price');
            let roomDescription = button.getAttribute('data-description');
            let roomNumberBed = button.getAttribute('data-number-bed');
            let roomBedType = button.getAttribute('data-type-bed');
            let roomQuantity = button.getAttribute('data-quantity');

            // Update the modal's content.
            let modalTitle = showModal.querySelector('.modal-title');
            let modalBody = showModal.querySelector('.room-info');
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
            let roomImage = button.getAttribute('data-room-image');
            if (roomImage) {
                modalBody.querySelector('#roomImage').src = '../img/rooms/' + roomImage;
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
        let modal = document.getElementById('show');
        modal.style.display = 'block';
    }

    function closeModal2() {
        let modal = document.getElementById('show');
        modal.style.display = 'none';
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let editModal = document.getElementById('Editstaff');
        editModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget; // Button that triggered the modal
            let staffId = button.getAttribute('data-id2');
            let staffName = button.getAttribute('data-name2');
            let staffEmail = button.getAttribute('data-email2');
            let staffPhone = button.getAttribute('data-phone2');
            let staffPassword = button.getAttribute('data-password2');
            let staffPosition = button.getAttribute('data-position2');

            // Update the modal's content.
            let modalStaffID = editModal.querySelector('#editstaffId');
            let modalStaffName = editModal.querySelector('#editname');
            let modalStaffEmail = editModal.querySelector('#editemail');
            let modalStaffPhone = editModal.querySelector('#editphone');
            let modalStaffPassword = editModal.querySelector('#editpassword');
            let modalStaffPosition = editModal.querySelector('#editposition');

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
        let editModal = document.getElementById('Editguests');
        editModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget; // Button that triggered the modal
            let guestId = button.getAttribute('data-id');
            let guestName = button.getAttribute('data-name');
            let guestEmail = button.getAttribute('data-email');
            let guestPhone = button.getAttribute('data-phone');
            let guestAddress = button.getAttribute('data-address');
            let guestNationality = button.getAttribute('data-nationality');
            let guestPassportNumber = button.getAttribute('data-passport');
            let guestDateOfBirth = button.getAttribute('data-dateofbirth');
            let guestGender = button.getAttribute('data-gender');

            // Update the modal's content.
            let modalGuestID = editModal.querySelector('#editguestId');
            let modalGuestName = editModal.querySelector('#editName');
            let modalGuestEmail = editModal.querySelector('#editEmail');
            let modalGuestPhone = editModal.querySelector('#editPhone');
            let modalGuestAddress = editModal.querySelector('#editAddress');
            let modalGuestNationality = editModal.querySelector('#editNationality');
            let modalGuestPassportNumber = editModal.querySelector('#editPassportNumber');
            let modalGuestDateOfBirth = editModal.querySelector('#editDateOfBirth');
            let modalGuestGender = editModal.querySelector('#editGender');

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
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let viewModal = document.getElementById('viewBooking');
        viewModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget; // Button that triggered the modal

            let bookingDetails = {
                name: button.getAttribute('data-name'),
                phone: button.getAttribute('data-phone'),
                nationality: button.getAttribute('data-nationality'),
                email: button.getAttribute('data-email'),
                passportNumber: button.getAttribute('data-passport-number'),
                dateOfBirth: button.getAttribute('data-date-of-birth'),
                gender: button.getAttribute('data-gender'),
                address: button.getAttribute('data-address'),
                checkInDate: button.getAttribute('data-checkin-date'),
                checkOutDate: button.getAttribute('data-checkout-date'),
                roomName: button.getAttribute('data-room-name'),
                quantity: button.getAttribute('data-quantity'),
                services: button.getAttribute('data-services')
            };

            // Update the modal's content
            let modalElements = {
                name: viewModal.querySelector('#viewName'),
                phone: viewModal.querySelector('#viewPhone'),
                nationality: viewModal.querySelector('#viewNationality'),
                email: viewModal.querySelector('#viewEmail'),
                passportNumber: viewModal.querySelector('#viewPassportNumber'),
                dateOfBirth: viewModal.querySelector('#viewDateOfBirth'),
                gender: viewModal.querySelector('#viewGender'),
                address: viewModal.querySelector('#viewAddress'),
                checkInDate: viewModal.querySelector('#viewCheckInDate'),
                checkOutDate: viewModal.querySelector('#viewCheckOutDate'),
                room: viewModal.querySelector('#viewRoom'),
                quantity: viewModal.querySelector('#viewQuantity'),
                services: viewModal.querySelector('#viewServices')
            };

            modalElements.name.textContent = bookingDetails.name;
            modalElements.phone.textContent = bookingDetails.phone;
            modalElements.nationality.textContent = bookingDetails.nationality;
            modalElements.email.textContent = bookingDetails.email;
            modalElements.passportNumber.textContent = bookingDetails.passportNumber;
            modalElements.dateOfBirth.textContent = bookingDetails.dateOfBirth;
            modalElements.gender.textContent = bookingDetails.gender;
            modalElements.address.textContent = bookingDetails.address;
            modalElements.checkInDate.textContent = bookingDetails.checkInDate;
            modalElements.checkOutDate.textContent = bookingDetails.checkOutDate;
            modalElements.room.textContent = bookingDetails.roomName;
            modalElements.quantity.textContent = bookingDetails.quantity;

            // Populate services
            modalElements.services.textContent = bookingDetails.services.join(', ');
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let billingModal = document.getElementById('addRowModal');
        billingModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget; // Button that triggered the modal

            let billingDetails = {
                name: button.getAttribute('data-name'),
                email: button.getAttribute('data-email'),
                status: button.getAttribute('data-status'),
                amount: button.getAttribute('data-amount'),
                date: button.getAttribute('data-date'),
                billingId: button.getAttribute('data-id') // Assuming this is the BillingID
            };

            // Update the modal's content
            let modalElements = {
                name: billingModal.querySelector('#guestName'),
                email: billingModal.querySelector('#guestEmail'),
                status: billingModal.querySelector('#billingStatus'),
                amountText: billingModal.querySelector('#billingAmount'),
                amountInput: billingModal.querySelector('#transactionAmount'),
                date: billingModal.querySelector('#billingDate'),
                billingId: billingModal.querySelector('input[name="BillingID"]')
            };

            modalElements.name.textContent = billingDetails.name;
            modalElements.email.textContent = billingDetails.email;
            modalElements.status.textContent = billingDetails.status;
            modalElements.amountText.textContent = billingDetails.amount;
            modalElements.amountInput.value = billingDetails.amount; // Prefill the transaction amount
            modalElements.date.textContent = billingDetails.date;
            modalElements.billingId.value = billingDetails.billingId;
        });
    });
</script>
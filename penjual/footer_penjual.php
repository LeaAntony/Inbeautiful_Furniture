</div>

<!-- Footer -->
<footer class="bg-dark text-white footer mt-4 z-3">
    <div class="row col">
        <div style="text-align: center;">
            <p>&copy; 2023 by InBeautiful Room</p>
        </div>
    </div>
</footer>
</div>
</div>

<!-- JS -->
<script>
    // menampilkan tanggal
    var today = new Date();
    var tanggal = today.getDate();
    var bulan = today.getMonth() + 1;
    var tahun = today.getFullYear();
    var tanggalStr = tanggal + '/' + bulan + '/' + tahun;
    document.getElementById("tanggal").innerHTML = tanggalStr;

    //CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    $('.keluar').on('click', function (e) {
        e.preventDefault();

        const href = $(this).attr('href')

        swal.fire({
            title: 'Inbeautiful',
            text: 'Anda yakin ingin keluar?',
            icon: 'warning',
            confirmButtonColor: '#dc3545',
            showCancelButton: true,
            confirmButtonText: 'Keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    })

</script>
</body>

</html>
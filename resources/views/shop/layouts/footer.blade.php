<div class="modal fade" id="pelatihans" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-default"> </h3>
                
            </div>
            
            <div class="modal-body"  style="padding-bottom: 0px;padding-top: 0px;">
                <div class="row content" id="content1">
                    <div class="col-12">
                        <img width="100%" src="/assets/content/img/theme/password.png">
                    </div>
                    <hr>
                    <div class="col-12">
                        <div style="font-size: 18px; color: #dd3343;">
                            <b>YUK UPDATE PASSWORD</b>
                        </div>
                        <div style="font-size: 12px;" >
                            Segera Update Password Anda, Dikarenakan Terdapat Informasi Pribadi seperti slip gaji, rekap absensi yang bersifat rahasia.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer tombol" id="tombol1">
                <table width="100%">
                    <tr>
                        <td align="center">
                            <button type="button" onclick="Finish()" class="btn btn-absen ml-auto">Update Password</button> 
                        </td>
                    </tr> 
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
</div>
</div>
<!--   Core   -->
<script src="/assets/content/js/plugins/jquery/dist/jquery.min.js"></script>
<script src="/assets/content/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!--   Argon JS   -->
<script src="/js/app.js"></script>
<script src="/assets/content/js/argon-dashboard.min.js?v=1.1.0"></script>
<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="/assets/splash/vendor/select2/select2.min.js"></script>

<!-- <script src="/js/app.js"></script> -->

<!-- Add Firebase products that you want to use -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>

<script type="text/javascript">
    $('.menusxx').on('click', function () {
       
      $('.loading').attr('style','display: block');

  });
</script>


<script>
    window.TrackJS &&
    TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
    });
</script>

<script type="text/javascript">
    function angka(e) {
      if (!/^[0-9]+$/.test(e.value)) {
        e.value = e.value.substring(0,e.value.length-1);
    }
}

</script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
     <script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-analytics.js"></script>
     <script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-auth.js"></script>
     <script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-messaging.js"></script>


     
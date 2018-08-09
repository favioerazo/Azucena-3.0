


    <!-- Aqui puede colocar codigo->


    
    <!-- Scroll to Top Button-->
    <a class="btn-info scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Listo para irte <?php echo "".$nombre[0];?>?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Selecciona Salir si estas listo para finalizar la sesion.</div>
          <div class="modal-footer">
            <button class="btn btn-success" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-danger" href="../core/core.logout.php">Salir</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../include_libs/vendor/jquery/jquery.min.js"></script>
    <script src="../include_libs/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../include_libs/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../include_libs/vendor/datatables/jquery.dataTables.js"></script>
    <script src="../include_libs/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../include_libs/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page
    <script src="../include_libs/js/sb-admin-datatables.min.js"></script>-->
  </div></div></div></div>

</body>
<footer>
    <div class="footer-copyright">
      <div class="container"><center>
        <strong>
         Azucena 3.0 - BFD Dev. © <?php echo date("Y"); ?> Copyright 
        </strong></center>
      </div>
    </div>
  </footer>
</html>

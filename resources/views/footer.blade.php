            <!--footer section start-->
            <footer>
                <script src="https://cdn.smooch.io/smooch.min.js"></script>
<script>
Smooch.init({ appToken: '9wokwlxqcy4n953mn3l2zz9y7' });
</script>
                2016 &copy; Devless.

            </footer>
            <!--footer section end-->



        </div>
        <!-- body content end-->
    </section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="{{ Request::secure(url('/js/jquery-1.10.2.min.js')) }}"></script>
<script src="{{ Request::secure(url('/js/jquery-migrate.js')) }}"></script>
<script src="{{ Request::secure(url('/js/bootstrap.min.js')) }}"></script>
<!--notification pan-->
<script src="{{ Request::secure(url('/js/modernizr.min.js')) }}"></script>

<!--Nice Scroll-->
<script src="{{ Request::secure(url('/js/jquery.nicescroll.js')) }}" type="text/javascript"></script>

<!--right slidebar-->
<script src="{{ Request::secure(url('/js/slidebars.min.js')) }}"></script>

<!--switchery-->
<script src="{{ Request::secure(url('/js/switchery/switchery.min.js')) }}"></script>
<script src="{{ Request::secure(url('/js/switchery/switchery-init.js')) }}"></script>

<!--Sparkline Chart-->
<script src="{{ Request::secure(url('/js/sparkline/jquery.sparkline.js')) }}"></script>
<script src="{{ Request::secure(url('/js/sparkline/sparkline-init.js')) }}"></script>

<!--Form Validation-->
<script src="{{ Request::secure(url('/js/bootstrap-validator.min.js')) }}" type="text/javascript"></script>

<!--Form Wizard-->
<script src="{{ Request::secure(url('/js/jquery.steps.min.js')) }}" type="text/javascript"></script>
<script src="{{ Request::secure(url('/js/jquery.validate.min.js')) }}" type="text/javascript"></script>

<!--wizard initialization-->
<script src="{{ Request::secure(url('/js/wizard-init.js')) }}" type="text/javascript"></script>


<!--common scripts for all pages-->
<script src="{{ Request::secure(url('/js/scripts.js')) }}"></script>
<!-- Ace Editor -->
@if(\Request::path() != 'console')
  <script src="{{ Request::secure(url('/js/ace/ace.js')) }}" type="text/javascript" ></script>
  <script src="{{ Request::secure(url('/js/ace/theme-github.js')) }}" type="text/javascript" ></script>
  <script src="{{ Request::secure(url('/js/ace/mode-php.js')) }}" type="text/javascript" ></script>
  <script src="{{ Request::secure(url('/js/ace/jquery-ace.min.js')) }}" type="text/javascript" ></script>
@endif
@include('notifier')
</body>
</html>

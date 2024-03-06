<div id="loader" class="loader" style="display:block;">
    <div class="loader-col"></div>
    <div class="loader-body">
        <div class="text-string">Please wait...</div>
        <div class="sk-cube-grid">
            <div class="sk-cube sk-cube1"></div>
            <div class="sk-cube sk-cube2"></div>
            <div class="sk-cube sk-cube3"></div>
            <div class="sk-cube sk-cube4"></div>
            <div class="sk-cube sk-cube5"></div>
            <div class="sk-cube sk-cube6"></div>
            <div class="sk-cube sk-cube7"></div>
            <div class="sk-cube sk-cube8"></div>
            <div class="sk-cube sk-cube9"></div>
        </div>
    </div>
</div>

<style type="text/css">
    /* Common loader styles */
    .loader {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1111;
    }
    .loader-col {
        width: 100%;
        height: 100%;
    }
    .loader-body {
        width: 100px;
        height: 100px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
    .text-string {
        text-align: center;
        color: #fff;
        font-weight: bold;
        margin-bottom: 20px;
        font-family: Arial, sans-serif;
    }

    /* Custom loader styles */
    .sk-cube-grid {
        width: 60px;
        height: 60px;
        margin: 0 auto;
    }

    .sk-cube {
        width: 33%;
        height: 33%;
        background-color: #db3434;
        float: left;
        animation: sk-cube-grid-animation 0.8s infinite ease-in-out; /* Reduced duration to 0.5 seconds */

    }

    @keyframes sk-cube-grid-animation {
        0%, 70%, 100% {
            transform: scale3D(1, 1, 1);
        }
        35% {
            transform: scale3D(0, 0, 1);
        }
    }

    .sk-cube1 {
        animation-delay: 0.2s;
    }

    .sk-cube2 {
        animation-delay: 0.3s;
    }

    .sk-cube3 {
        animation-delay: 0.4s;
    }

    .sk-cube4 {
        animation-delay: 0.1s;
    }

    .sk-cube5 {
        animation-delay: 0.2s;
    }

    .sk-cube6 {
        animation-delay: 0.3s;
    }

    .sk-cube7 {
        animation-delay: 0s;
    }

    .sk-cube8 {
        animation-delay: 0.1s;
    }

    .sk-cube9 {
        animation-delay: 0.2s;
    }
</style>
<script type="text/javascript">
   document.addEventListener('DOMContentLoaded', function() {
       setTimeout(function() {
           closeLoader('none');
       }, 500);
       window.addEventListener('beforeunload', function() {
           closeLoader('none');
       });
   });
   function loader(val) {
       document.getElementById("loader").style.display = val;
   }
   function closeLoader(val) {
       loader(val);
   }

</script>


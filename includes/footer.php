    </body>
    <script>
        const btn = document.getElementById("eye");
        var pass = document.querySelector("input[type=password]");
        btn.addEventListener('click', function(){
            if (pass.type === "password"){
                pass.type = "text";
            }
            else{
                pass.type = "password";
            }
        });
        btn.addEventListener('mouseover', function(){
            btn.setAttribute('fill', '#bf0000');
        });
        btn.addEventListener('mouseout', function(){
            btn.setAttribute('fill', '#666666');
        });

</script>
</html>   
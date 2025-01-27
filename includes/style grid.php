<style>
@charset "UTF-8";

*,
*::before,
*::after {
    margin: 0;
    padding: 0;
}


.logo{
    grid-area:l;
    width:100%;
    height:100%;
    background-color: #BF0000;
    border-radius: 0px 0px 60px 0px;
}



.search{
    grid-area:s;
    width:100%;
    height:121px;
    background-color:#242024;
    border-radius: 0px 0px 30px 30px;
}

.filter{
    grid-area:f;
    width:370px;
    height:755px;
    background-color:#DDDDDD; 
    border-radius: 0px 30px 0px 0px;
}

.mainbox{
    grid-area:m;
    width:950px;
    height:755px;
    background:wheat;
}

.cardinfo{
    grid-area:c;
    width:555px;
    height:881px;
    background-color:#DDDDDD;
}

.footer{
    grid-area:ft;
    width:100%;
    height:45px;
    background: #BF0000;
}

#container{
    display:grid;
    grid-template-areas:
    'l l s s s c c c'
    'f f m m m c c c'
    'f f m m m c c c'
    'f f m m m c c c'
    'f f m m m c c c'
    'ft ft ft ft ft ft ft ft';
    background-color: #f3f4f5;
    height:100%;
}




</style>
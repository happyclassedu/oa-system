var obj_arrow = document.getElementById('arrow');

obj_arrow.onclick=function(){
    mdi_splitter_arrow();
}

var mdi_splitter = 0;

function mdi_splitter_arrow() {
    if(mdi_splitter == 1) {
        mdi_splitter = 0;
        parent.frame_body.cols="186,7,*";
        obj_arrow.src="../img/mdi_splitter_arrow_l.gif";
    } else {
        mdi_splitter = 1;
        parent.frame_body.cols="0,7,*";
        obj_arrow.src="../img/mdi_splitter_arrow_r.gif";
    }
}
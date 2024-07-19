let videoList = document.querySelectorAll('.video-list-container .list');
var docus = document.querySelectorAll(".doc")

videoList.forEach(vid =>{
    vid.onclick = () =>{
        let src1 = vid.querySelector('.list-video').src;
        let title = vid.querySelector('.list-title').innerHTML;
        document.querySelector('.main-video-container .main-video').src = src1;
        document.querySelector('.main-video-container .main-video').play();
        document.querySelector('.main-video-container .main-vid-title').innerHTML = title;
    };
});

docus.forEach(docu => {
    docu.addEventListener("click", function(e) {
        window.location.href = docu.dataset.doc;
    })
});
'use strict';

//初期設定では答えを非表示
document.getElementById("answerDisplay").style.display ="none";

function buttonClick(){
    document.getElementById('answerChoice1-2')
    // ボタンの変更
    .classList.add('answerBox');

    //答えの表示設定
    const p1 = document.getElementById("answerDisplay");
	if(p1.style.display=="block"){
		// noneで非表示
		p1.style.display ="none";
	}else{
		// blockで表示
		p1.style.display ="block";
	}

}
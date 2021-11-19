'use strict';

//問題の選択肢と写真の配列を作る
const optionGroups = [
['たかなわ', 'たかわ', 'こうわ'],
['かめいど', 'かめど', 'かめと'],
['こうじまち', 'かゆまち', 'おかとまち'],
['おなりもん', 'ごせいもん', 'おかどもん'],
['とどろき', 'たたら', 'たたりき'],
['しゃくじい', 'せきこうい', 'いじい'],
['ぞうしき', 'ざっしき', 'ざっしょく'],
['おかちまち', 'みとちょう', 'ごしろちょう'],
['ししぼね', 'ろっこつ', 'しこね'],
['こぐれ', 'こばく', 'こしゃく'],
];

const answerGroups = ["たかなわ","かめいど","こうじまち","おなりもん","とどろき","しゃくじい","ぞうしき","おかちまち","ししぼね","こぐれ"]

let questionPhotos = [
['img/takanawa.png'],
['img/kameido.png'],
['img/koujimachi.png'],
['img/onarimon.png'],
['img/todoroki.png'],
['img/syakujii.png'],
['img/zoshiki.png'],
['img/okachimachi.png'],
['img/shishibone.png'],
['img/kogure.png'],
];

//フィッシャー・イェーツのシャッフル
//範囲を狭めながら、最後の要素とランダムに選んだ要素を入れ替えていく
//配列のコピーを作成してそれをシャッフルしたい
//const optionGroupsCopy = Array.from (optionGroups,
//  function shuffle(arr){ 
//	for (let i = arr.length - 1; i > 0; i--){
//		const j = Math.floor(Math.random() * (i + 1));
//		[arr[j],arr[i]] = [arr[i],arr[j]];
//	}
//	return arr;
//}


//const optionGroupsAfter = shuffle([...optionGroups]);
//console.log(optionGroupsAfter);
////console.log([optionGroupsCopy]);


// const optionGroupsCopy = optionGroups.slice();
//  const optionGroupsCopy = optionGroups.map(function shuffle(arr){ 
//  	for (let i = arr.length - 1; i > 0; i--){
//  		const j = Math.floor(Math.random() * (i + 1));
//  		[arr[j],arr[i]] = [arr[i],arr[j]];
//  	}
//  	return arr;
//  })
//[[[[1,4,5],6],3],2]

function shuffle(arr){ 
	for (let k = arr.length - 1; k > 0; k--){
		const j = Math.floor(Math.random() * (k + 1));
		[arr[j],arr[k]] = [arr[k],arr[j]];
	}
	return arr;
}
optionGroups.map(shuffle);
//console.log([optionGroups]);


//const optionGroupsCopy = [...optionGroups].map(function shuffle(arr){ 
//	for (let i = arr.length - 1; i > 0; i--){
//		const j = Math.floor(Math.random() * (i + 1));
//		[arr[j],arr[i]] = [arr[i],arr[j]];
//	}
//	return arr;
//})
// const optionGroupsBefore = shuffle([...optionGroups]);
// const shuffleArray = (optionGroups) => {
// 	const optionGroupsCopy = [...optionGroups]
// 	for (let i = optionGroupsCopy.length - 1; i > 0; i--){
// 		let rand = Math.floor(Math.random() * (i + 1))
// 		let tmpStorage = optionGroupsCopy[i]
// 		optionGroupsCopy[i] = optionGroupsCopy[rand]
// 		optionGroupsCopy[rand] = tmpStorage
// 	}
// 	return optionGroupsCopy
// }

// console.log([optionGroupsAfter]);

// function shuffle(arr){ 
// 	for (let i = arr.length - 1; i > 0; i--){
// 		const j = Math.floor(Math.random() * (i + 1));
// 		[arr[j],arr[i]] = [arr[i],arr[j]];
// 	}
// 	return arr;
// }

// const shuffledOptions = shuffle([...optionGroups]);
// shuffledOptions.forEach(choice => {
// 	const li = document.createElement('li');
// 	li.textContent = choice;
// 	li.addEventListener('click',() => {})
// 	choices.appendChild(li);
// });

//console.log([optionGroupsCopy]);
//console.log([optionGroups]);
// console.log(optionGroupsCopy);
/*
let question1 = optionGroups[0];
console.log(question1);//たかなわ、たかわ、こうわ
let question1 = optionGroups[0][0];
console.log(question1);//たかなわ

let photo1 = questionPhotos[0];
console.log(photo1);
*/
let main = '';

for(let i = 0; i<optionGroups.length; i++){
	//ループ処理を１０回
    //以下でmainの空文字列の中を指定
    //``内の文字列中でもiを変数としてもってくるために${i+1}、${i}をid名に導入
    //id 名に変数をもってくることで、2ページ目からのクリック関数が機能するようになる
    //loop.innerHTML = main; でhtmlに指定した要素(id=loop)にmainを表示できるようになる

	// let question = optionGroups[i]
	// console.log(question)
	main+=`<div class='mainWrapper'>`
	     +`<h3>${i+1}.この地名はなんて読む？</h3>`
         +`<img src= "${questionPhotos[i]}"  alt='問題${i+1}の写真' width=auto`
         +`<ul>`
         +`<li class='buttonOfOptionNumber' id = 'answerChoice_${i}_0' input type='button' value='button' onclick="clickSelectedButton(${i},0)">${optionGroups[i][0]}</li>`
         +`<li class='buttonOfOptionNumber' id = 'answerChoice_${i}_1' input type='button' value='button' onclick="clickSelectedButton(${i},1)">${optionGroups[i][1]}</li>`
         +`<li class='buttonOfOptionNumber' id = 'answerChoice_${i}_2' input type='button' value='button' onclick="clickSelectedButton(${i},2)">${optionGroups[i][2]}</li>`
         +`<div id='answerDisplay${[i]}' class='firstIsInvisible'>`
         +`<li><span>正解！</span></li>`
         +`<li>正解は ${answerGroups[i]} です！</li>`
         +`</div>`
         +`<div id='incorrectAnswerDisplay${[i]}' class='incorrectFirstIsInvisible'>`
         +`<li><span>不正解！</span></li>`
         +`<li>正解は ${answerGroups[i]} です！</li>`
         +`</div>`
         +`</ul>`
		 +`</div>`
		//  console.log(`answerChoice(${i},0,1)`);

loop.innerHTML = main;
};


//以下で各設問のボタンクリックによって（）内の引数を呼び出す
//for文が終わっているのでid名に${i}をつけられない。代わりに引数で表す。引数の左端が${i}を対応しているので表すことができる。
//引数を代入するので、変数を代入できるletで宣言する
function clickSelectedButton(questionNumber, optionNumberOfQuestions) {
	
	//引数と文字列は分ける
	//ボタンの表示
	let buttonOfOptionNumber = document.getElementById('answerChoice_'+ questionNumber +'_'+ optionNumberOfQuestions);
	//クリックしたらとりあえず全て赤にする
	buttonOfOptionNumber.classList.add('incorrectAnswerBox');

	for (let d = 0; d < 3; d++) {
		if (optionGroups[questionNumber][d] === answerGroups[questionNumber]) {
			let trueChoice = document.getElementById('answerChoice_'+ questionNumber +'_'+ d);
			trueChoice.classList.add('answerBox');
			trueChoice.classList.remove('incorrectAnswerBox');
		}
	}

	//下の正解不正解のボックスの表示
	if (optionGroups[questionNumber][optionNumberOfQuestions] === answerGroups[questionNumber]) {
		document.getElementById('answerDisplay'+ questionNumber).style.display = 'block';
	} else {
		document.getElementById('incorrectAnswerDisplay'+ questionNumber).style.display = 'block';
	}

	document.getElementById('answerChoice_'+ questionNumber +'_0').style.pointerEvents = 'none';
	document.getElementById('answerChoice_'+ questionNumber +'_1').style.pointerEvents = 'none';
	document.getElementById('answerChoice_'+ questionNumber +'_2').style.pointerEvents = 'none';
}


//サイドメニューの開閉
// function subMenu(){
// 	let focus = document.getElementById('subMenu');
// 	if (focus.style.display ='none') {
// 		focus.style.display = 'block';		
// 	}else{
// 		focus.style.display = 'none';
// 	}

// 	// if (focus.style.display ='block') {
// 	// 	focus.style.display = 'none';		
// 	// }else{
// 	// 	focus.style.display = 'block';
// 	// }
// }
function hamburger() {
  //document.getElementById('line1').classList.toggle('line_1');
  //document.getElementById('line2').classList.toggle('line_2');
  //document.getElementById('line3').classList.toggle('line_3');
  document.getElementById('menu').classList.toggle('in');
}
document.getElementById('hamburger').addEventListener('click' , function () {
  hamburger();
} );






	
// console.log(answerDisplayBox);

// if (optionNumberOfQuestions === 0) {
// 	if (answerNumber === questionNumber) {
// 		////正解ボタンの見た目の変化
// 		//document.getElementById(`answerChoice_${i}_0_${i}`).classList.add('correctAnswerButton')
// 		////答えを表示する
// 		//document.getElementById(`answerChoice_${i}_0_${i}`) .classList.add('answerBox');


// 		//正解ボタンの見た目の変化
// 		buttonOfOptionNumber1.style.background = '#287dff';
// 		buttonOfOptionNumber1.style.color = '#ffffff';
// 		buttonOfOptionNumber1.style.border = '#287dff';
   
// 		//答えを表示する
// 		answerDisplayBox.style = 'display: block';
// 		incorrectAnswerDisplayBox.style = 'display: none';
//    } else if (answerNumber === questionNumber+1) {
// 	   //不正解ボタンの見た目の変化
// 	   buttonOfOptionNumber1.style.background = '#ff5128';
// 	   buttonOfOptionNumber1.style.color = '#ffffff';
// 	   buttonOfOptionNumber1.style.border = '#ff5128';
   
// 	   //答えを表示する
// 	   answerDisplayBox.style = 'display: none';
// 	   incorrectAnswerDisplayBox.style = 'display: block';
//    }
// } else if (optionNumberOfQuestions === 1) {
// 	if (answerNumber === questionNumber) {
// 		//正解ボタンの見た目の変化
// 		buttonOfOptionNumber2.style.background = '#287dff';
// 		buttonOfOptionNumber2.style.color = '#ffffff';
// 		buttonOfOptionNumber2.style.border = '#287dff';
   
// 		//答えを表示する
// 		answerDisplayBox.style = 'display: block';
// 		incorrectAnswerDisplayBox.style = 'display: none';
//    } else if (answerNumber === questionNumber+1) {
// 	   //不正解ボタンの見た目の変化
// 	   buttonOfOptionNumber2.style.background = '#ff5128';
// 	   buttonOfOptionNumber2.style.color = '#ffffff';
// 	   buttonOfOptionNumber2.style.border = '#ff5128';
   
// 	   //答えを表示する
// 	   answerDisplayBox.style = 'display: none';
// 	   incorrectAnswerDisplayBox.style = 'display: block';
//    }
// } else if (optionNumberOfQuestions === 2) {
// 	if (answerNumber === questionNumber) {
// 		//正解ボタンの見た目の変化
// 		buttonOfOptionNumber3.style.background = '#287dff';
// 		buttonOfOptionNumber3.style.color = '#ffffff';
// 		buttonOfOptionNumber3.style.border = '#287dff';
   
// 		//答えを表示する
// 		answerDisplayBox.style = 'display: block';
// 		incorrectAnswerDisplayBox.style = 'display: none';
//    } else if (answerNumber === questionNumber+1) {
// 	   //不正解ボタンの見た目の変化
// 	   buttonOfOptionNumber3.style.background = '#ff5128';
// 	   buttonOfOptionNumber3.style.color = '#ffffff';
// 	   buttonOfOptionNumber3.style.border = '#ff5128';
   
// 	   //答えを表示する
// 	   answerDisplayBox.style = 'display: none';
// 	   incorrectAnswerDisplayBox.style = 'display: block';
//    }
// }
// }

//if (answerNumber === 1) {
//	 //正解ボタンの見た目の変化
//	 buttonOfOptionNumber1.style.background = '#287dff';
//	 buttonOfOptionNumber1.style.color = '#ffffff';
//	 buttonOfOptionNumber1.style.border = '#287dff';
//
//	 //答えを表示する
//	 answerDisplayBox.style = 'display: block';
//	 incorrectAnswerDisplayBox.style = 'display: none';
//} else if (answerNumber === 0) {
//	//不正解ボタンの見た目の変化
//	buttonOfOptionNumber1.style.background = '#ff5128';
//	buttonOfOptionNumber1.style.color = '#ffffff';
//	buttonOfOptionNumber1.style.border = '#ff5128';
//
//	//答えを表示する
//	answerDisplayBox.style = 'display: none';
//	incorrectAnswerDisplayBox.style = 'display: block';
//}

// if (optionNumberOfQuestions === 0) {
// 	//正解ボタンの見た目の変化
// 	buttonOfOptionNumber1.style.background = '#287dff';
// 	buttonOfOptionNumber1.style.color = '#ffffff';
// 	buttonOfOptionNumber1.style.border = '#287dff';

// 	//答えを表示する
// 	answerDisplayBox.style = 'display: block';
// 	incorrectAnswerDisplayBox.style = 'display: none';

// } else if (optionNumberOfQuestions === 1) {
// 	//不正解ボタン１の見た目の変化
// 	buttonOfOptionNumber2.style.background = '#ff5128';
// 	buttonOfOptionNumber2.style.color = '#ffffff';
// 	buttonOfOptionNumber2.style.border = '#ff5128';

// 	//答えを表示する
// 	answerDisplayBox.style = 'display: none';
// 	incorrectAnswerDisplayBox.style = 'display: block';

// } else if (optionNumberOfQuestions === 2) {
// 	//不正解ボタン２の見た目の変化
// 	buttonOfOptionNumber3.style.background = '#ff5128';
// 	buttonOfOptionNumber3.style.color = '#ffffff';
// 	buttonOfOptionNumber3.style.border = '#ff5128';

// 	//答えを表示する
// 	answerDisplayBox.style = 'display: none';
// 	incorrectAnswerDisplayBox.style = 'display: block';
// }


// //正解の場合
// //初期設定では答えを非表示
// document.getElementById(`answerDisplay[${i,0}]`).style.display ='none';

// function AnswerButtonClick(){
// 	// ボタンの変更
//     document.getElementById(`answerChoice[${i,0}]`) .classList.add('answerBox');

//     //答えの表示設定
//     const p1 = document.getElementById('answerDisplay');
// 	if(p1.style.display=='block'){
// 		// noneで非表示
// 		p1.style.display ='none';
// 	}else{
// 		// blockで表示
// 		p1.style.display ='block';
// 	}
// }

// //不正解の場合
// //初期設定では答えを非表示
// document.getElementById('incorrectAnswerDisplay').style.display ='none';

// function incorrectAnswerButtonClick(){
// 	// ボタンの変更
//     document.getElementById('answerChoice[${i,1}]').classList.add('incorrectAnswerBox');
//     document.getElementById('answerChoice[${i,0}]').classList.add('answerBox');

//     //答えの表示設定
//     const p1 = document.getElementById('incorrectAnswerDisplay');
// 	if(p1.style.display=='block'){
// 		// noneで非表示
// 		p1.style.display ='none';
// 	}else{
// 		// blockで表示
// 		p1.style.display ='block';
// 	}
// }

// //不正解の場合二つ目
// //初期設定では答えを非表示
// document.getElementById('incorrectAnswerDisplay').style.display ='none';

// function incorrectAnswerButtonClick2(){
// 	// ボタンの変更
//     document.getElementById('answerChoice[${i,2}]').classList.add('incorrectAnswerBox');
// 	document.getElementById('answerChoice[${i,0}]').classList.add('answerBox');

//     //答えの表示設定
//     const p1 = document.getElementById('incorrectAnswerDisplay');
// 	if(p1.style.display=='block'){
// 		// noneで非表示
// 		p1.style.display ='none';
// 	}else{
// 		// blockで表示
// 		p1.style.display ='block';
// 	}
// }



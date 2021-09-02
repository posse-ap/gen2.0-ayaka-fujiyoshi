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

let questionPhotos = [
['https://d1khcm40x1j0f.cloudfront.net/quiz/34d20397a2a506fe2c1ee636dc011a07.png'],
['https://d1khcm40x1j0f.cloudfront.net/quiz/512b8146e7661821c45dbb8fefedf731.png'],
['https://d1khcm40x1j0f.cloudfront.net/quiz/ad4f8badd896f1a9b527c530ebf8ac7f.png'],
['https://d1khcm40x1j0f.cloudfront.net/quiz/ee645c9f43be1ab3992d121ee9e780fb.png'],
['https://d1khcm40x1j0f.cloudfront.net/quiz/6a235aaa10f0bd3ca57871f76907797b.png'],
['https://d1khcm40x1j0f.cloudfront.net/quiz/0b6789cf496fb75191edf1e3a6e05039.png'],
['https://d1khcm40x1j0f.cloudfront.net/quiz/23e698eec548ff20a4f7969ca8823c53.png'],
['https://d1khcm40x1j0f.cloudfront.net/quiz/50a753d151d35f8602d2c3e2790ea6e4.png'],
['https://d1khcm40x1j0f.cloudfront.net/words/8cad76c39c43e2b651041c6d812ea26e.png'],
['https://d1khcm40x1j0f.cloudfront.net/words/34508ddb0789ee73471b9f17977e7c9c.png'],
];

//フィッシャー・イェーツのシャッフル
//範囲を狭めながら、最後の要素とランダムに選んだ要素を入れ替えていく
const optionGroupsCopy = optionGroups.slice();
const optionGroupsAfter = optionGroupsCopy.map(function shuffle(arr){ 
	for (let i = arr.length - 1; i > 0; i--){
		const j = Math.floor(Math.random() * (i + 1));
		[arr[j],arr[i]] = [arr[i],arr[j]];
	}
	return arr;
})

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

console.log([optionGroupsAfter]);
console.log([optionGroupsCopy]);
console.log([optionGroups]);
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
         +`<li class='buttonOfOptionNumber1' id = 'answerChoice_${i}_0_1' input type='button' value='button' onclick="clickSelectedButton(${i},0,1)">${optionGroups[i][0]}</li>`
         +`<li class='buttonOfOptionNumber2' id = 'answerChoice_${i}_1_0' input type='button' value='button' onclick="clickSelectedButton(${i},1,0)">${optionGroups[i][1]}</li>`
         +`<li class='buttonOfOptionNumber3' id = 'answerChoice_${i}_2_0' input type='button' value='button' onclick="clickSelectedButton(${i},2,0)">${optionGroups[i][2]}</li>`
         +`<div id='answerDisplay${[i]}' class='firstIsInvisible'>`
         +`<li><span>正解！</span></li>`
         +`<li>正解は ${optionGroups[i][0]} です！</li>`
         +`</div>`
         +`<div id='incorrectAnswerDisplay${[i]}' class='incorrectFirstIsInvisible'>`
         +`<li><span>不正解！</span></li>`
         +`<li>正解は ${optionGroups[i][0]} です！</li>`
         +`</div>`
         +`</ul>`
		 +`</div>`
		//  console.log(`answerChoice(${i},0,1)`);

loop.innerHTML = main;
};


//以下で各設問のボタンクリックによって（）内の引数を呼び出す
//for文が終わっているのでid名に${i}をつけられない。代わりに引数で表す。引数の左端が${i}を対応しているので表すことができる。
//引数を代入するので、変数を代入できるletで宣言する
function clickSelectedButton(questionNumber, optionNumberOfQuestions, answerNumber) {
	
	//引数と文字列は分ける
	let buttonOfOptionNumber1 = document.getElementById('answerChoice_'+ questionNumber + '_0_1');
	let buttonOfOptionNumber2 = document.getElementById('answerChoice_'+ questionNumber + '_1_0');
	let buttonOfOptionNumber3 = document.getElementById('answerChoice_'+ questionNumber + '_2_0');
	let answerDisplayBox = document.getElementById('answerDisplay' + questionNumber);
	let incorrectAnswerDisplayBox = document.getElementById('incorrectAnswerDisplay' + questionNumber);
// console.log(answerDisplayBox);

if (optionNumberOfQuestions === 0) {
	if (answerNumber === 1) {
		//正解ボタンの見た目の変化
		buttonOfOptionNumber1.style.background = '#287dff';
		buttonOfOptionNumber1.style.color = '#ffffff';
		buttonOfOptionNumber1.style.border = '#287dff';
   
		//答えを表示する
		answerDisplayBox.style = 'display: block';
		incorrectAnswerDisplayBox.style = 'display: none';
   } else if (answerNumber === 0) {
	   //不正解ボタンの見た目の変化
	   buttonOfOptionNumber1.style.background = '#ff5128';
	   buttonOfOptionNumber1.style.color = '#ffffff';
	   buttonOfOptionNumber1.style.border = '#ff5128';
   
	   //答えを表示する
	   answerDisplayBox.style = 'display: none';
	   incorrectAnswerDisplayBox.style = 'display: block';
   }
} else if (optionNumberOfQuestions === 1) {
	if (answerNumber === 1) {
		//正解ボタンの見た目の変化
		buttonOfOptionNumber2.style.background = '#287dff';
		buttonOfOptionNumber2.style.color = '#ffffff';
		buttonOfOptionNumber2.style.border = '#287dff';
   
		//答えを表示する
		answerDisplayBox.style = 'display: block';
		incorrectAnswerDisplayBox.style = 'display: none';
   } else if (answerNumber === 0) {
	   //不正解ボタンの見た目の変化
	   buttonOfOptionNumber2.style.background = '#ff5128';
	   buttonOfOptionNumber2.style.color = '#ffffff';
	   buttonOfOptionNumber2.style.border = '#ff5128';
   
	   //答えを表示する
	   answerDisplayBox.style = 'display: none';
	   incorrectAnswerDisplayBox.style = 'display: block';
   }
} else if (optionNumberOfQuestions === 2) {
	if (answerNumber === 1) {
		//正解ボタンの見た目の変化
		buttonOfOptionNumber3.style.background = '#287dff';
		buttonOfOptionNumber3.style.color = '#ffffff';
		buttonOfOptionNumber3.style.border = '#287dff';
   
		//答えを表示する
		answerDisplayBox.style = 'display: block';
		incorrectAnswerDisplayBox.style = 'display: none';
   } else if (answerNumber === 0) {
	   //不正解ボタンの見た目の変化
	   buttonOfOptionNumber3.style.background = '#ff5128';
	   buttonOfOptionNumber3.style.color = '#ffffff';
	   buttonOfOptionNumber3.style.border = '#ff5128';
   
	   //答えを表示する
	   answerDisplayBox.style = 'display: none';
	   incorrectAnswerDisplayBox.style = 'display: block';
   }
}
}

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

//if (optionNumberOfQuestions === 0) {
//	//正解ボタンの見た目の変化
//	buttonOfOptionNumber1.style.background = '#287dff';
//	buttonOfOptionNumber1.style.color = '#ffffff';
//	buttonOfOptionNumber1.style.border = '#287dff';
//
//	//答えを表示する
//	answerDisplayBox.style = 'display: block';
//	incorrectAnswerDisplayBox.style = 'display: none';
//
//} else if (optionNumberOfQuestions === 1) {
//	//不正解ボタン１の見た目の変化
//	buttonOfOptionNumber2.style.background = '#ff5128';
//	buttonOfOptionNumber2.style.color = '#ffffff';
//	buttonOfOptionNumber2.style.border = '#ff5128';
//
//	//答えを表示する
//	answerDisplayBox.style = 'display: none';
//	incorrectAnswerDisplayBox.style = 'display: block';
//
//} else if (optionNumberOfQuestions === 2) {
//	//不正解ボタン２の見た目の変化
//	buttonOfOptionNumber3.style.background = '#ff5128';
//	buttonOfOptionNumber3.style.color = '#ffffff';
//	buttonOfOptionNumber3.style.border = '#ff5128';
//
//	//答えを表示する
//	answerDisplayBox.style = 'display: none';
//	incorrectAnswerDisplayBox.style = 'display: block';
//}


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



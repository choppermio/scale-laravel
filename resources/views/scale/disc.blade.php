@extends('layouts.app')

@section('content')
<style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        #chart {
            width: 400px;
            height: 400px;
            position: relative;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }
        #x-axis, #y-axis {
            position: absolute;
            background-color: black;
        }
        #x-axis {
            width: 100%;
            height: 1px;
            top: 50%;
        }
        #y-axis {
            width: 1px;
            height: 100%;
            left: 50%;
        }
        .tick {
            position: absolute;
            background-color: black;
        }
        .x-tick {
            width: 1px;
            height: 5px;
            bottom: -2px;
        }
        .y-tick {
            height: 1px;
            width: 5px;
            right: -2px;
        }
        .label {
            position: absolute;
            font-size: 10px;
        }
        .quadrant {
            position: absolute;
            font-size: 20px;
            font-weight: bold;
        }
        .axis-label {
            position: absolute;
            font-size: 12px;
            font-weight: bold;
        }
        #plot-area {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        #ranking {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .rank-item {
            font-size: 24px;
            font-weight: bold;
        }
        #ranking {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .rank-item {
            font-size: 24px;
            font-weight: bold;
            color: #007bff; /* Bootstrap primary color */
        }
        .card {
            margin-bottom: 15px; /* Space between cards */
        }
        .btn {
            margin-top: 10px; /* Space above buttons */
        }
    </style>
</head>
<body>




    <div class="row">
       

        <div class="col-md-6 col-sm-12 col-xs-12 order-sm-1 order-md-2 order-1 questionss" dir="rtl" style="text-align: right;">
<div class="card"><div class="card-body">
    <input type="radio" name="q1" value="D" id="q1a"><label for="q1a"> أتخذ قراراتي بعجلة وسرعة</label><br>
    <input type="radio" name="q1" value="C" id="q1b"><label for="q1b"> أتخذ قراراتي بحرصٍ وتأنٍ </label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q2" value="D" id="q2a"><label for="q2a">أ- أتطلع دائمًا إلى أن أكون المسؤول الأول في الأعمال وأُصدر التعليمات</label><br>
    <input type="radio" name="q2" value="C" id="q2b"><label for="q2b">ب- أُفضل أن أكون داعمًا وأتبع التعليمات</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q3" value="D" id="q3a"><label for="q3a">أ- أتحدث أمام الناس بطلاقة وثقة كبيرة</label><br>
    <input type="radio" name="q3" value="C" id="q3b"><label for="q3b">ب- لا أحبذ الحديث أمام الناس، لذا أتردد كثيرًا في الحديث إذا تعرضت لموقف مثل هذا</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q4" value="D" id="q4a"><label for="q4a">أ- شخصيتي حماسية وأتفاعل مع الآخرين سريعًا</label><br>
    <input type="radio" name="q4" value="C" id="q4b"><label for="q4b">ب- شخصيتي متأنية، ولا أفضل الاحتكاك مع من لا اعرفهم مباشرة </label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q5" value="D" id="q5a"><label for="q5a">أ- أميل إلى إنتاج قدر أكبر من الأعمال، وإن ضعفت الدقة قليلًا</label><br>
    <input type="radio" name="q5" value="C" id="q5b"><label for="q5b">ب- الدقة في إنتاج الأعمال أمر مهم جدًا، حتى وإن تسبب ذلك في إنتاج قدر أقل من الأعمال</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q6" value="D" id="q6a"><label for="q6a">أ- الروتين أمر مزعج جدًا، لذا أحاول دائمًا التجديد، هذا يشعرني بالحيوية والنشاط </label><br>
    <input type="radio" name="q6" value="C" id="q6b"><label for="q6b">ب- الروتين جميل، فهو يشعرني بالهدوء والراحة والطمأنينة</label>
</div></div>
-----------

<div class="card"><div class="card-body">
    <input type="radio" name="q7" value="I" id="q7a"><label for="q7a">أ- من الجميل مشاركة مشاعرك للآخرين، لا خطورة في ذلك، فهذا يجعلك على اتصال دائم بهم </label><br>
    <input type="radio" name="q7" value="S" id="q7b"><label for="q7b">ب- لا أشارك مشاعري مع الآخرين، فالحذر من مشاركة الآخرين مشاعرك أمر ضروري جدًا</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q8" value="I" id="q8a"><label for="q8a">أ- أميل إلى المغامرة والتجارب الجديدة </label><br>
    <input type="radio" name="q8" value="S" id="q8b"><label for="q8b">ب- أميل إلى التحفظ وعدم المغامرة، فالمغامرة غالباً ما تثير المخاوف داخلي</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q9" value="I" id="q9a"><label for="q9a">أ- لا حاجة لأن يعرفني أحد على الأخرين، أبادر من تلقاء نفسي في التعرف عليهم</label><br>
    <input type="radio" name="q9" value="S" id="q9b"><label for="q9b">ب- التعرف على الآخرين أمر يدعو إلى الإحراج، الأفضل أن يقدمني شخص ما للتعرف على الآخرين</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q10" value="I" id="q10a"><label for="q10a">أ- أنزعج جدًا من الأشخاص البطيئين والأعمال البطيئة، لماذا لا يكون كل شيء سريعًا؟  </label><br>
    <input type="radio" name="q10" value="S" id="q10b"><label for="q10b">ب- لما العجلة؟ طالما أن الأمور ستتم، فمن الجيد أن تتم بشكل متأنٍ </label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q11" value="I" id="q11a"><label for="q11a">أ- أنا واثق ومنطلق، وطالما أن الأخرون يتحدثون في كل شيء فلا يجب أن أبالي بحديثهم</label><br>
    <input type="radio" name="q11" value="S" id="q11b"><label for="q11b">ب- رأي الآخرين مهم جدًا، لذا أهتم بحديث الآخرين واُنصت جيدًا</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q12" value="I" id="q12a"><label for="q12a">أ- أستطيع أن أندمج في أكثر من عمل في نفس الوقت، وأنتج قدر كبير جدًا من المهام </label><br>
    <input type="radio" name="q12" value="S" id="q12b"><label for="q12b">ب- أرتب وأنظم أعمالي حسب الأولوية، الاندماج في أكثر من عمل في نفس الوقت، أمر مرهق وغير جيد</label>
</div></div>
***************************
<div class="card"><div class="card-body">
    <input type="radio" name="q13" value="S" id="q13a"><label for="q13a">أ- أتعامل بتلقائية وعفوية، والمرح يغلب على شخصيتي</label><br>
    <input type="radio" name="q13" value="D" id="q13b"><label for="q13b">ب- أفضل التعامل بشكل جدي وصارم</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q14" value="I" id="q14a"><label for="q14a">أ- تجذبني الفضولية في تتبع أخبار الغير</label><br>
    <input type="radio" name="q14" value="C" id="q14b"><label for="q14b">ب- تجذبني المعلومات والأخبار، وغالبًا ما أبذل جهدي في التأكد من مصادرها </label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q15" value="S" id="q15a"><label for="q15a">أ- أحرص دائمًا على أن يحبني الجميع، فهذا الأمر يشعرني بالراحة</label><br>
    <input type="radio" name="q15" value="D" id="q15b"><label for="q15b">ب- حب الآخرين لي، ليس أمرًا ذا أولوية مقارنة بالإنجاز، فالإنجاز هو الأمر الذي يشعرني بالراحة</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q16" value="I" id="q16a"><label for="q16a">أ- علاقاتي الاجتماعية ومشاعري هي المؤثر الأول على قراراتي  </label><br>
    <input type="radio" name="q16" value="C" id="q16b"><label for="q16b">ب- الحقائق والأدلة هي المؤثر الأول على قراراتي، رأي الآخرين لا يمثل أهمية لدي</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q17" value="S" id="q17a"><label for="q17a">أ- أُخبر الجميع عن مشاعري بكل أريحية</label><br>
    <input type="radio" name="q17" value="D" id="q17b"><label for="q17b">ب- من غير الجيد مشاركة الآخرين مشاعري</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q18" value="I" id="q18a"><label for="q18a">أ- أنا اجتماعي وأميل إلى بناء علاقات جديدة </label><br>
    <input type="radio" name="q18" value="C" id="q18b"><label for="q18b">ب- أشعر بأن علاقاتي كلما كانت محدودة كان ذلك أفضل</label>
</div></div>
--------------------
<div class="card"><div class="card-body">
    <input type="radio" name="q19" value="S" id="q19a"><label for="q19a">أ- أميل إلى تجربة كل ما هو جديد، هذا الأمر يثير حماسي</label><br>
    <input type="radio" name="q19" value="D" id="q19b"><label for="q19b">ب- أميل إلى استخدام الطرق المجربة مسبقًا، فهي أكثر أمانًا</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q20" value="I" id="q20a"><label for="q20a">أ- تجذبني القصص والروايات حتى وإن كانت ممزوجة بنسج من الخيال</label><br>
    <input type="radio" name="q20" value="C" id="q20b"><label for="q20b">ب- أرى أن القصص والروايات ليست ذات مصداقية عالية الأولى الاهتمام بالقضايا المعاصرة  </label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q21" value="S" id="q21a"><label for="q21a">أ- العمل منفردًا يشعرني بالملل، من الجميل العمل مع الآخرين، فذلك يجعل العمل أكثر متعة </label><br>
    <input type="radio" name="q21" value="D" id="q21b"><label for="q21b">ب- أُفضل أن أقوم بالعمل منفردًا، فالآخرين مصدر إلهاء، وقد يضعفوا من جودة العمل</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q22" value="I" id="q22a"><label for="q22a">أ- أرى أن شخصيتي جاذبة، لذا من السهل أن أكوّن صداقات بسرعة وسلاسة</label><br>
    <input type="radio" name="q22" value="C" id="q22b"><label for="q22b">ب- أرى أن شخصيتي منغلقة، وعادةً ما يأخذ الآخرون وقتًا طويلًا ليصحبوا أصدقاءً لي </label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q23" value="S" id="q23a"><label for="q23a">أ- دائمًا ما أحاول إرضاء جميع من حولي، لأكون في نظرهم بشكل جيد</label><br>
    <input type="radio" name="q23" value="D" id="q23b"><label for="q23b">ب- ثقتي في نفسي كبيرة، لذا لا أبالي بما يقوله الآخرون عني، فتلك وجهة نظرهم</label>
</div></div>
<div class="card"><div class="card-body">
    <input type="radio" name="q24" value="I" id="q24a"><label for="q24a">أ- القيام بالأعمال المتكررة يشعرني بالملل والاستياء، من الصعب عليّ اعتياد هذا الأمر</label><br>
    <input type="radio" name="q24" value="C" id="q24b"><label for="q24b">ب- الأعمال المتكررة بالنسبة لي هي مجرد عمل كغيرها من الأعمال، والقيام بها هو أمر اعتيادي</label>
</div></div>

<button onclick="selectRandomChoices()" class="btn btn-secondary">اختيار اجابات عشوائية</button>
<button class="count btn btn-success">حساب</button>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 order-md-2 order-1 the-chart" style="display: none;">


    <div id="chart">
        <div id="x-axis"></div>
        <div id="y-axis"></div>
        <div id="quadrants"></div>
        <svg id="plot-area"></svg>
    </div>
    <div style="display: none;" id="ranking"></div>
    <div class="card">
        <div class="card-header">النتائج</div>
        <div class="card-body"><div id="ranking2"></div></div></div>
</div>
</div>


    


<script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add a button to trigger the count
    //   const countButton = document.createElement('button');
    //   countButton.textContent = 'Count Checked Letters';
    //   document.body.appendChild(countButton);
    
      countButton.addEventListener('click', function() {
        const counts = countCheckedLetters();
        console.log('Counts:', counts);
        // alert(`Counts: D=${counts.D}, C=${counts.C}, I=${counts.I}, S=${counts.S}`);
      });
    
      function countCheckedLetters() {
        let counts = {
          D: 0,
          C: 0,
          I: 0,
          S: 0
        };
    
        const checkedRadios = document.querySelectorAll('input[type="radio"]:checked');
    
        checkedRadios.forEach(radio => {
          const letter = radio.value;
          if (letter in counts) {
            counts[letter]++;
          }
        });
    
        return counts;
      }
    });



    
    </script>

    <script>
        function selectRandomChoices() {
  // Get all question groups (each div containing radio buttons)
  const questionGroups = document.querySelectorAll('div');

  questionGroups.forEach((group, index) => {
    // Get all radio buttons in this group
    const radioButtons = group.querySelectorAll('input[type="radio"]');
    
    // If there are radio buttons in this group
    if (radioButtons.length > 0) {
      // Randomly select 0 or 1
      const randomIndex = Math.floor(Math.random() * 2);
      
      // Check the randomly selected radio button
      radioButtons[randomIndex].checked = true;
    }
  });

  // After selecting random choices, count the results
  const counts = countCheckedLetters();
  console.log('Random selection counts:', counts);
  return counts;
}



// Call this function when you want to make random selections
// selectRandomChoices();
    </script>

    <script>
        function countSelections() {
  let counts = {
    top: 0,
    bottom: 0,
    right: 0,
    left: 0
  };

  const radioButtons = document.querySelectorAll('input[type="radio"]:checked');

  radioButtons.forEach((radio, index) => {
    const questionNumber = index + 1;
    const value = radio.value;

    if (questionNumber <= 12) {
      // First 12 questions
      if (value === 'D' || value === 'I') {
        counts.top++;
      } else if (value === 'C' || value === 'S') {
        counts.bottom++;
      }
    } else if (questionNumber <= 24) {
      // Questions 13-24
      if (value === 'S' || value === 'I') {
        counts.right++;
      } else if (value === 'D' || value === 'C') {
        counts.left++;
      }
    }
  });

  return counts;
}

// Function to display the results
function displayResults() {
  const counts = countSelections();
  console.log('Counts:', counts);
//   alert(`
//     Top (D/C in Q1-12): ${counts.top}
//     Bottom (I/S in Q1-12): ${counts.bottom}
//     Right (S/I in Q13-24): ${counts.right}
//     Left (D/C in Q13-24): ${counts.left}
//   `);
}

// Function to make random selections
function selectRandomChoices() {
  const questionGroups = document.querySelectorAll('div');

  questionGroups.forEach((group, index) => {
    const radioButtons = group.querySelectorAll('input[type="radio"]');
    if (radioButtons.length > 0) {
      const randomIndex = Math.floor(Math.random() * 2);
      radioButtons[randomIndex].checked = true;
    }
  });

  displayResults();
}

// Set up the buttons when the DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
//   const randomButton = document.createElement('button');
//   randomButton.textContent = 'Select Random Choices';
//   document.body.appendChild(randomButton);

//   const countButton = document.createElement('button');
//   countButton.textContent = 'Count Current Selections';
//   document.body.appendChild(countButton);

//   randomButton.addEventListener('click', selectRandomChoices);
//   countButton.addEventListener('click', displayResults);
});
    </script>


    <script>

        $('.count').click(function() {

            const selectedAnswers = [];


// Collect question numbers and checked values
$('input[type="radio"]:checked').each(function() {
    const questionNumber = $(this).attr('name'); // Get the question number
    const valueChecked = $(this).val(); // Get the checked value
    selectedAnswers.push({ question: questionNumber, value: valueChecked });

});


$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



 // Send data to Laravel controller via AJAX
 $.ajax({
            url: '{{ route("disc.store.answers") }}', // URL to your Laravel route
            type: 'POST',
            data: {
                answers: selectedAnswers,
            },
            success: function(response) {
                console.log('Data sent successfully:', response);
                // Handle success response (e.g., show a message)
            },
            error: function(xhr) {
                console.error('Error sending data:', xhr);
                // Handle error response (e.g., show an error message)
            }
        });


           selectedd =  countSelections();
           console.log(selectedd);
        
        const chart = document.getElementById('chart');
        const xAxis = document.getElementById('x-axis');
        const yAxis = document.getElementById('y-axis');
        const quadrants = document.getElementById('quadrants');
        const plotArea = document.getElementById('plot-area');
        const ranking = document.getElementById('ranking');

        // Create ticks and labels
        for (let i = -12; i <= 12; i++) {
            if (i !== 0) {
                // X-axis ticks and labels
                const xTick = document.createElement('div');
                xTick.className = 'tick x-tick';
                xTick.style.left = `${(i + 12) * (100/24)}%`;
                xAxis.appendChild(xTick);

                if (i % 3 === 0) {
                    const xLabel = document.createElement('div');
                    xLabel.className = 'label';
                    xLabel.textContent = Math.abs(i);
                    xLabel.style.left = `${(i + 12) * (100/24)}%`;
                    xLabel.style.top = '52%';
                    chart.appendChild(xLabel);
                }

                // Y-axis ticks and labels
                const yTick = document.createElement('div');
                yTick.className = 'tick y-tick';
                yTick.style.top = `${(12 - i) * (100/24)}%`;
                yAxis.appendChild(yTick);

                if (i % 3 === 0) {
                    const yLabel = document.createElement('div');
                    yLabel.className = 'label';
                    yLabel.textContent = Math.abs(i);
                    yLabel.style.top = `${(12 - i) * (100/24)}%`;
                    yLabel.style.left = '52%';
                    chart.appendChild(yLabel);
                }
            }
        }

        // Add axis labels
        const xAxisLabel = document.createElement('div');
        xAxisLabel.className = 'axis-label';
        xAxisLabel.textContent = 'محور الأولويات';
        xAxisLabel.style.right = '0';
        xAxisLabel.style.top = '52%';
        chart.appendChild(xAxisLabel);

        const yAxisLabel = document.createElement('div');
        yAxisLabel.className = 'axis-label';
        yAxisLabel.textContent = 'محور السرعة';
        yAxisLabel.style.top = '0';
        yAxisLabel.style.left = '52%';
        chart.appendChild(yAxisLabel);

        // Add quadrant labels
        const quadrantLabels = ['D', 'I', 'C', 'S'];
        const quadrantPositions = [
            {top: '10%', left: '10%'},
            {top: '10%', right: '10%'},
            {bottom: '10%', left: '10%'},
            {bottom: '10%', right: '10%'}
        ];

        quadrantLabels.forEach((label, index) => {
            const quadrant = document.createElement('div');
            quadrant.className = 'quadrant';
            quadrant.textContent = label;
            Object.assign(quadrant.style, quadrantPositions[index]);
            quadrants.appendChild(quadrant);
        });

        function calculateQuadrantAreas(points) {
            const areas = {D: 0, I: 0, S: 0, C: 0};
            for (let i = 0; i < points.length; i++) {
                const [x1, y1] = points[i];
                const [x2, y2] = points[(i + 1) % points.length];
                
                const area = Math.abs(x1 * y2 - x2 * y1) / 2;
                
                if (y1 >= 0 && y2 >= 0) {
                    if (x1 >= 0 || x2 >= 0) areas.I += area;
                    if (x1 <= 0 || x2 <= 0) areas.D += area;
                } else if (y1 <= 0 && y2 <= 0) {
                    if (x1 >= 0 || x2 >= 0) areas.S += area;
                    if (x1 <= 0 || x2 <= 0) areas.C += area;
                } else {
                    const ratio = Math.abs(y1) / (Math.abs(y1) + Math.abs(y2));
                    const upperArea = area * (1 - ratio);
                    const lowerArea = area * ratio;
                    
                    if (x1 >= 0 || x2 >= 0) {
                        areas.I += upperArea;
                        areas.S += lowerArea;
                    }
                    if (x1 <= 0 || x2 <= 0) {
                        areas.D += upperArea;
                        areas.C += lowerArea;
                    }
                }
            }
            return areas;
        }

        function rankQuadrants(areas) {
            return Object.entries(areas)
                .sort((a, b) => b[1] - a[1])
                .map(entry => entry[0]);
        }

        function displayRanking(rankedQuadrants) {
            ranking.innerHTML = '';
            rankedQuadrants.forEach((quadrant, index) => {
                const rankItem = document.createElement('div');
                rankItem.className = 'rank-item';
                rankItem.textContent = quadrant;
                ranking.appendChild(rankItem);
            });
        }

        function plotPoints(points) {
            const svgNS = "http://www.w3.org/2000/svg";
            const scale = 400 / 24; // 400px / 24 units
            const center = 200; // 400px / 2

            let pathD = '';
            points.forEach((point, index) => {
                const [x, y] = point;
                const svgX = center + x * scale;
                const svgY = center - y * scale;

                // Create circle for point
                const circle = document.createElementNS(svgNS, 'circle');
                circle.setAttribute('cx', svgX);
                circle.setAttribute('cy', svgY);
                circle.setAttribute('r', 4);
                circle.setAttribute('fill', 'red');
                plotArea.appendChild(circle);

                // Add to path
                pathD += (index === 0 ? 'M' : 'L') + `${svgX},${svgY}`;
            });

            // Close the path
            pathD += 'Z';

            // Create path
            const path = document.createElementNS(svgNS, 'path');
            path.setAttribute('d', pathD);
            path.setAttribute('stroke', 'red');
            path.setAttribute('stroke-width', 2);
            path.setAttribute('fill', 'rgba(255,0,0,0.2)');
            plotArea.appendChild(path);

            // Calculate areas and rank quadrants
            const areas = calculateQuadrantAreas(points);
            const rankedQuadrants = rankQuadrants(areas);
            displayRanking(rankedQuadrants);
            
            console.log("Areas:", areas); // For debugging
        }

        // Plot the specific points from the image
        plotPoints([[selectedd.right,0], [0,selectedd.top], [-selectedd.left,0], [0,-selectedd.bottom]]);


        
            let i_area = selectedd.right + selectedd.top;
            let c_area = selectedd.left + selectedd.bottom;
            let d_area = selectedd.left + selectedd.top;
            let s_area = selectedd.right + selectedd.bottom;

            let areas = [
                { name: 'I', value: i_area },
                { name: 'S', value: s_area },
                { name: 'D', value: d_area },
                { name: 'C', value: c_area }
            ];

            areas.sort((a, b) => b.value - a.value);

            let sortedNames = areas.map(area => area.name);
            $.ajax({
            url: '{{ route("disc.store.result") }}', // URL to your Laravel route
            type: 'POST',
            data: {
                sorted_names: sortedNames, // Send the sorted names
                 // Replace with the actual user ID
                 // Replace with the actual test number
                
            },
            success: function(response) {
                console.log('Data sent successfully:', response);
                $('.questionss').hide()
                $('.the-chart').show()
                // Handle success response (e.g., show a message)
            },
            error: function(xhr) {
                console.error('Error sending data:', xhr);
                // Handle error response (e.g., show an error message)
            }
        });
            console.log(sortedNames);

            // Display the sorted names as text inside #ranking2
            document.getElementById('ranking2').innerHTML = sortedNames.join(', ');
        

    });
    </script>
@endsection
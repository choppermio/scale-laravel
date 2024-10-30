
@extends('layouts.app')

@section('content')
<style>
        body {
            font-family: Arial, sans-serif;
        }
        .options label {
            display: inline-block;
            margin-right: 10px;
        }
        .hidden {
            display: none;
        }
    </style>
     <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-header {
            font-weight: bold;
            background: #81a7a5;
            color: white;
        }
        .options label {
            margin-right: 15px;
        }

    </style>
</head>
<body>
<div class="container mt-5" style="direction:rtl; text-align:right;">
    <h1 class="text-center">اختبار أنماط التعلم</h1>
    <form id="learningStyleForm">
        <!-- Questions will be dynamically inserted here -->
    </form>
    <div id="results" class="hidden mt-4">
        <h2>نتائجك</h2>
        <canvas id="resultsChart" width="400" height="200"></canvas>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const questions = [
        { number: 1, text: "تستهويني القراءة من الكتب مباشرة", category: "لغوي / لفظي" },
        { number: 2, text: "أحب كتابة المقالات والمواضيع الإنشائية", category: "لغوي / لفظي" },
        { number: 3, text: "يمكنني إلقاء خطاب أمام الناس دون تردد أو تلعثم", category: "لغوي / لفظي" },
        { number: 4, text: "استخدم كثيرًا مفردات متنوعة وقد تكون غير متداولة في كتاباتي أو أحاديثي، حيث تشعرني بتمكني من اللغة التي أتحدث بها", category: "لغوي / لفظي" },
        { number: 5, text: "ـأنا مهتم بتعلم اللغات المختلفة، من الجميل أن أمتلك أكثر من لغة أتحدث بها", category: "لغوي / لفظي" },
        { number: 6, text: "أستطيع أن أكتشف الأخطاء الإملائية بسهولة، ولذلك أكتب بشكل قوي دون أخطاء إملائية", category: "لغوي / لفظي" },
        { number: 7, text: "مهتم بالأدب والشعر، وكثيرًا ما استخدم الأبيات الشعرية التي أحفظها أثناء حديثي مع الآخرين", category: "لغوي / لفظي" },
        { number: 8, text: "أستطيع تدوين الملاحظات بكل يسر وسهولة، بل وغالبًا ما أجدها عن مراجعتها مختصرة وواضحة وشاملة", category: "لغوي / لفظي" },
        { number: 9, text: "أستطيع القيام بالعمليات الحسابية في ذهني بسهولة", category: "رياضي/ حسابي" },
        { number: 10, text: "مادتي الرياضيات و العلوم من ضمن المواد المفضلة لدي في الدراسة", category: "رياضي/ حسابي" },
        { number: 11, text: "أستمتع بحل المسائل الرياضية", category: "رياضي/ حسابي" },
        { number: 12, text: "أستطيع تحليل الأمور بشكل منطقي ودقيق", category: "رياضي/ حسابي" },
        { number: 13, text: "أعتقد أن لكل شيء تفسيراته المنطقية، ويحتاج إلى بحث وتحليل فقط", category: "رياضي/ حسابي" },
        { number: 14, text: "أنجذب بشكل كبير لعالم التقنية", category: "رياضي/ حسابي" },
        { number: 15, text: "أهتم بالتفاصيل جدًا، لأن التفاصيل تبين حقيقة تشكل الأمر، وبالتالي أستطيع الحكم عليه", category: "رياضي/ حسابي" },
        { number: 16, text: "أشعر بأنني قوي في الاستنتاج والاستدلال، ولذلك إقناعي للآخرين في أي أمر لا يتطلب مني مجهود عالٍ", category: "رياضي/ حسابي" },
        { number: 17, text: "يمكنني تخيل مشاهد القصص وأحداثها كما لو أنها حقيقية أمام عيني", category: "بصري / مكاني" },
        { number: 18, text: "تأسرني الألوان الممزوجة بشكل متقن وجميل، وتغمرني بالسعادة بمجرد النظر إليها", category: "بصري / مكاني" },
        { number: 19, text: "أستمتع كثيرا بألعاب البازل (الصور المقطعة)، وألعاب المتاهة، والألغاز الصورية", category: "بصري / مكاني" },
        { number: 20, text: "أرى بأنني أستطيع الرسم بشكل جيد", category: "بصري / مكاني" },
        { number: 21, text: "أستطيع أن اعتمد في تنقلاتي على رسم الخرائط في ذهني، وتكون صحيحة في الغالب دون الحاجة إلى تطبيقات الخرائط مثل جوجل ماب وغيرها", category: "بصري / مكاني" },
        { number: 22, text: "أستطيع أن أصف موقع (مكان ما) لشخص آخر بكل يسر وسهولة وبدقة كبيرة، كما لو أنني أرى الموقع أمام عيني الآن", category: "بصري / مكاني" },
        { number: 23, text: "أستطيع ترتيب ديكورات لمنزل أو مكتب أو غرفة بشكل جميل جدًا، لدرجة أن يشيد الآخرون بجمالها", category: "بصري / مكاني" },
        { number: 24, text: "أتذكر وجوه الآخرين في الغالب أكثر من أسمائهم، كثيرًا ما يمر عليّ موقف أني رأيت فلانًا في مكانٍ ما، ولكنني أحاول جاهدًا تذكر اسمه", category: "بصري / مكاني" },
        { number: 25, text: "الأنشطة البدنية أمرًا أساسيًا وروتينيًا في حياتي اليومية، ولا أستطيع التخلي عنه", category: "جسدي / حركي" },
        { number: 26, text: "لا أستطيع البقاء والجلوس لفترة طويلة لأنها من الأمور المملة جدًا، من الجيد أن أقف قليلًا وأتحرك ثم أعود", category: "جسدي / حركي" },
        { number: 27, text: "أفكاري المفضلة تأتيني عندما أكون في عملي أو أثناء المشي لمسافات طويلة ، أو وأنا مشغول ببعض الأنشطة البدنية", category: "جسدي / حركي" },
        { number: 28, text: "أنا عادة أستخدم لغة الجسد كإشارات اليد وإيماءات الوجه أثناء حديثي مع الآخرين", category: "جسدي / حركي" },
        { number: 29, text: "يستهويني العمل في الأنشطة اليدوية، كفك وتركيب الأشياء، الإصلاحات المنزلية كالنجارة والسباكة ..الخ", category: "جسدي / حركي" },
        { number: 30, text: "أشعر أنني بارع في الألعاب التي تحتاج إلى تحكم وتركيز عالٍ، كألعاب التصويب  ورمي السهام ... الخ", category: "جسدي / حركي" },
        { number: 31, text: "أشعر بأنني متميز في بناء المجسمات لذا أستمتع كثيرًا بهذا العمل", category: "جسدي / حركي" },
        { number: 32, text: "أشعر بأنني بارع في الألعاب الحركية مثل كرة القدم أو كرة السلة أو كرة الطائرة أو التزلج ...الخ", category: "جسدي / حركي" },
        { number: 33, text: "يجذبني عالم الحيوان، وغالبًا ما أحاول أن أتعمق فيه", category: "طبيعي / بيئي" },
        { number: 34, text: "يستهويني صيد الأسماك، لذلك أحاول جاهدًا بعدم التفريط في أي نزهة يمكنني خلالها ممارسة هذه الهواية", category: "طبيعي / بيئي" },
        { number: 35, text: "يستهويني البحث عن الصخور والأصداف والحشرات والعلوم الخاصة بها", category: "طبيعي / بيئي" },
        { number: 36, text: "أتفقد تقارير المناخ وتقلبات الأجواء باستمرار، فمن الجيد أن أكون على درايةٍ تامة بأحوال المناخ والأجواء من حولي", category: "طبيعي / بيئي" },
        { number: 37, text: "الطبيعة والنزه البرية، من أكثر الأمور التي تسعدني وتوازن حالتي المزاجية", category: "طبيعي / بيئي" },
        { number: 38, text: "تستهويني الأفلام التي تتحدث عن الكواكب والمجرات وما يمكن أن يتم استكشافه فيها", category: "طبيعي / بيئي" },
        { number: 39, text: "تستهويني تربية الحيوانات الأليفة والعناية بها", category: "طبيعي / بيئي" },
        { number: 40, text: "يستهويني جمع النباتات وزراعتها في حديقة المنزل والعناية بها", category: "طبيعي / بيئي" },
        { number: 41, text: "أشعر أن الله وهبني صوتًا جميلاً، كثيرًا ما يطريني من هم حولي بهذا الأمر", category: "موسيقي / ايقاعي" },
        { number: 42, text: "كثيرًا ما أجد نفسي أسير ويتردد في ذهني ألحان معينة", category: "موسيقي / ايقاعي" },
        { number: 43, text: "أهتم بعلوم المقامات كمقام الحجاز والصبا والنهاوند ... الخ، في أصوات القرّاء للقرآن الكريم والمنشدين", category: "موسيقي / ايقاعي" },
        { number: 44, text: "استمتع بتلحين الأبيات الشعرية", category: "موسيقي / ايقاعي" },
        { number: 45, text: "أحب أن أقتني الأجهزة الصوتية", category: "موسيقي / ايقاعي" },
        { number: 46, text: "أشعر أنني عند القراءة أو المذاكرة أو القيام بأمر ما، أركّز بشكل أكبر إذا كنت أستمع لشيء ما مصاحب معها", category: "موسيقي / ايقاعي" },
        { number: 47, text: "يمكنني تمييز الأصوات وتقييم الأفضل منها", category: "موسيقي / ايقاعي" },
        { number: 48, text: "تأسرني الأصوات الجميلة وخاصةً إذا كان يصاحبها الأداء المتقن", category: "موسيقي / ايقاعي" },
        { number: 49, text: "كثيرًا ما يستشيرني القريبون مني كالأهل والأصدقاء في الأمور الخاصة بهم", category: "اجتماعي" },
        { number: 50, text: "أمتلك كثيرًا من الأصدقاء في محيطي، وأتواصل معهم باستمرار", category: "اجتماعي" },
        { number: 51, text: "أعتبر نفسي قياديًا ، أو على الأقل أشعر بأن الآخرين يروني هكذا", category: "اجتماعي" },
        { number: 52, text: "أفضل قضاء أمسياتي في حفل جماعي على أن أبقى وحيدًا في المنزل", category: "اجتماعي" },
        { number: 53, text: "تستهويني أعمال التدريب أو التدريس، من الجميل أن أعلم أحدًا ما شيئًا مفيدًا", category: "اجتماعي" },
        { number: 54, text: "تستهويني جدًا الأعمال التطوعية، فأنا أمارسها بشغف وحب", category: "اجتماعي" },
        { number: 55, text: "أسعى دائمًا إلى تشجيع الآخرين وتحفيزهم، هذا الأمر يسعدني كثيرًا ويشعرني بالراحة النفسية", category: "اجتماعي" },
        { number: 56, text: "عادةً ما أقضي وقتا طويلًا للتأمل والتفكر في أسئلة الحياة المهمة", category: "شخصي / وجداني" },
        { number: 57, text: "لدي بعض الأهداف في حياتي أفكر فيها باستمرار", category: "شخصي / وجداني" },
        { number: 58, text: "لدي اهتمامات وهوايات خاصة بي أسعى جاهدًا لتحقيقها", category: "شخصي / وجداني" },
        { number: 59, text: "غالبًا ما أبحث عن نقاط قوتي ونقاط الضعف لدي لأعمل جاهدًا على تحسينها", category: "شخصي / وجداني" },
        { number: 60, text: "أقضي وقتًا طويلًا في البحث عن المصادر التي تحفز شخصيتي وتلهمني للتطور", category: "شخصي / وجداني" },
        { number: 61, text: "أعتبري شخصيتي مستقلة، فأنا قادر على التخطيط لنفسي ولمستقبلي دون تدخل طرف آخر", category: "شخصي / وجداني" },
        { number: 62, text: "غالبًا ما أدون أحداث حياتي الخاصة في مذكرات إلكترونية أو ورقية", category: "شخصي / وجداني" },
        { number: 63, text: "غالبًا ما يطرأ  على تفكيري البدء بمشروعي المستقبلي الخاص بي وحدي", category: "شخصي / وجداني" }
    ];

    // Shuffle questions
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    shuffleArray(questions);

    const form = document.getElementById('learningStyleForm');
iji=0;
    questions.forEach((question) => {
        iji++;
        const questionDiv = document.createElement('div');
        questionDiv.className = 'form-group card';
        questionDiv.innerHTML = `
            <p class="card-header">${iji}. ${question.text}</p>
            <div class="options card-body" data-name="q${question.number}" data-category="${question.category}"></div>
        `;
        form.appendChild(questionDiv);
    });

    const optionsContainers = document.querySelectorAll('.options');

    optionsContainers.forEach(container => {
        const name = container.getAttribute('data-name');
        for (let i = 1; i <= 10; i++) {
            const label = document.createElement('label');
            const input = document.createElement('input');
            input.type = 'radio';
            input.name = name;
            input.value = i;
            label.appendChild(input);
            label.appendChild(document.createTextNode(` ${i}`));
            container.appendChild(label);
        }
    });

    const submitButton = document.createElement('button');
    submitButton.type = 'submit';
    submitButton.className = 'btn btn-primary';
    submitButton.textContent = 'إرسال';
    form.appendChild(submitButton);

    let startTime;
    let timeoutId;

    
    

    form.addEventListener('submit', function(event) {
    event.preventDefault();
    clearTimeout(timeoutId);

    const results = {};
results2 = [];
optionsContainers.forEach(container => {
    const selected = container.querySelector('input[type="radio"]:checked');
        if (selected) {
            const questionId = container.getAttribute('data-name').replace('q', ''); // Extract question ID
            const answer = selected.value; // Selected answer
            results2.push({ question_id: questionId, answer: answer });
        }
});
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


$.ajax({
        url: '/thakaat-answers-store', // Laravel route to handle the request
        method: 'POST',
        data: {
             // CSRF token for security
            answers: results2
        },
        success: function(response) {
            // Handle the success response (e.g., show a success message or results)
            console.log('Data saved successfully', response);
        },
        error: function(error) {
            // Handle the error response
            console.error('Error saving data', error);
        }
    });

    optionsContainers.forEach(container => {
        const selected = container.querySelector('input[type="radio"]:checked');
        if (selected) {
            const category = container.getAttribute('data-category');
            if (!results[category]) {
                results[category] = 0;
            }
            results[category] += parseInt(selected.value);
        }
    });

    const totalScore = Object.values(results).reduce((sum, score) => sum + score, 0);

    const sortedResults = Object.entries(results)
        .map(([category, score]) => ({
            category,
            score,
            percentage: (score / totalScore) * 100
        }))
        .sort((a, b) => b.percentage - a.percentage);

    // Clear previous results
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = '<h2>نتائجك</h2>';

    // Display all results
    
sortedResults.forEach((item) => {
    const resultElement = document.createElement('p');
    resultElement.textContent = `${item.category}: ${item.score} (${item.percentage.toFixed(2)}%)`;
    resultsContainer.appendChild(resultElement);
});

// Send the results via AJAX
function sendResults(sortedResults) {
    $.ajax({
        url: '/store-thakaat-results', // Update with your route
        method: 'POST',
        data: {
            results: sortedResults,
            
        },
        success: function(response) {
            alert(response.message); // Notify the user
            $('#learningStyleForm').hide(); // Hide the form
        },
        error: function(xhr, status, error) {
            alert('An error occurred: ' + error);
        }
    });
}

// Call the function to send the results
sendResults(sortedResults);

    // Create chart
    const ctx = document.createElement('canvas');
    ctx.id = 'resultsChart';
    ctx.width = 400;
    ctx.height = 200;
    resultsContainer.appendChild(ctx);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: sortedResults.map(item => item.category),
            datasets: [{
                label: 'النسبة المئوية',
                data: sortedResults.map(item => item.percentage.toFixed(2)),
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF6384', '#36A2EB'
                ],
                borderColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF6384', '#36A2EB'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: 'توزيع أنماط التعلم (النسبة المئوية)'
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'النسبة المئوية'
                    },
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'النمط'
                    }
                }
            }
        }
    });

    resultsContainer.classList.remove('hidden');
});



    // Start timer when the page loads
    startTime = Date.now();

    // Set timeout for 70 seconds
    timeoutId = setTimeout(() => {
        alert('انتهى الوقت! يرجى إرسال إجاباتك الآن.');
        form.dispatchEvent(new Event('submit'));
    }, 70000);

    // Add event listener to radio buttons
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', () => {
            // Reset timer when a radio button is clicked
            clearTimeout(timeoutId);
            startTime = Date.now();
            timeoutId = setTimeout(() => {
                alert('انتهى الوقت! يرجى إرسال إجاباتك الآن.');
                form.dispatchEvent(new Event('submit'));
            }, 70000);
        });
    });
});
</script>
<button onclick="selectRandomChoices()">اختيار عشوائي</button>
<script>
        function selectRandomChoices() {
            const optionsContainers = document.querySelectorAll('.options.card-body'); // Ensure optionsContainers is defined

            optionsContainers.forEach(optionsContainers => {
                const radios = optionsContainers.querySelectorAll('input[type="radio"]');
                if (radios.length > 0) { // Ensure there are radio buttons in the container
                    const randomIndex = Math.floor(Math.random() * radios.length);
                    radios[randomIndex].checked = true;
                }
            });
        }


</script>
@endsection
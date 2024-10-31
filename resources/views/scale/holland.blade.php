@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
    <h1 class="text-center">اختبار هولاند</h1>
    <form id="hollandForm">
        <!-- Questions will be dynamically inserted here -->
    </form>
    <div id="results" class="hidden mt-4 card p-4" style="font-weight: bold;">
        <h2 class="card-header">نتائجك</h2>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const questions = [
        { number: 1, text: "يستهويني العمل على ماكينة في خط إنتاج ومراقبة أدائها.", category: "R" },
        { number: 2, text: "غالبًا ما أحاول إصلاح الأجهزة المنزلية بنفسي.", category: "R" },
        { number: 3, text: "من الممتع قيادة شاحنة نقل بضائع لإيصال الطلبات إلى المكاتب والمنازل.", category: "R" },
        { number: 4, text: "يستهويني العناية بالحيوانات الأليفة وتربيتها.", category: "R" },
        { number: 5, text: "أفضل طلاء جدار المنزل بنفسي عوضًا عن أجلب أحدًا من الخارج، أشعر بأنني سأتقن العمل أفضل منه.", category: "R" },
        { number: 6, text: "أحب أن أتعلم وأتعمق في فهم النظريات العلمية.", category: "I" },
        { number: 7, text: "أهتم كثيرًا بالتعمق في شخصيات قادة العالم.", category: "I" },
        { number: 8, text: "من المثير أن أعمل في مجالات التحقيق حول الجرائم وما شابهها.", category: "I" },
        { number: 9, text: "أستمتع كثيرًا بحل المسائل الرياضية والألغاز.", category: "I" },
        { number: 10, text: "تجذبني الأمور الغامضة وأحب مشاهدة أفلام وثائقية عنها.", category: "I" },
        { number: 11, text: "يستهويني تمثيل مشهد على مسرح أو برنامج يوتيوبي.", category: "A" },
        { number: 12, text: "أحب جمع الأعمال الفنية والاحتفاظ بها.", category: "A" },
        { number: 13, text: "من المثير المشاركة في كتابة سيناريو لفيلم أو برنامج تلفزيوني.", category: "A" },
        { number: 14, text: "أهتم بحضور الحفلات الفنية وزيارة المعارض والمتاحف.", category: "A" },
        { number: 15, text: "تجذبني الألحان الموسيقية والمقطوعات الغنائية أو الإنشادية بشكل كبير.", category: "A" },
        { number: 16, text: "أحب أن أكون أحد أفراد الفرق التي تقوم بتنظيم المناسبات الاجتماعية.", category: "S" },
        { number: 17, text: "أفضل العمل في الأماكن التي أستطيع من خلالها خدمة الآخرين ومساعدتهم.", category: "S" },
        { number: 18, text: "أهتم بالأعمال التطوعية مع الجهات والمجموعات في خدمة المجتمع.", category: "S" },
        { number: 19, text: "أفضل المجالات التي تهتم بممارسة أعمال التدريس والتدريب.", category: "S" },
        { number: 20, text: "أفضل أن أدير حلقات النقاش والحوار مع الآخرين.", category: "S" },
        { number: 21, text: "أفضل العمل في إدارة سوق يختص ببيع الجملة.", category: "E" },
        { number: 22, text: "تستهويني الأعمال الخاصة بالتسويق والمبيعات.", category: "E" },
        { number: 23, text: "أفضل مقابلة الشخصيات الهامة والاجتماع معهم.", category: "E" },
        { number: 24, text: "أعمل دائمًا على إقناع الآخرين بأفكاري، وأصر على تحقيقها.", category: "E" },
        { number: 25, text: "أستطيع أن أتفاوض بشكل جيد جدًا عندما أعمل على اتفاقيات ما.", category: "E" },
        { number: 26, text: "أستطيع أن أرتب وأنظم الملفات المكتبية، وأصنفها وأحفظها بشكل جيد.", category: "C" },
        { number: 27, text: "غالبًا ما أقوم بتدوين الملاحظات أثناء الاجتماعات.", category: "C" },
        { number: 28, text: "غالبًا ما أقوم بمراجعة وتصحيح السجلات والنماذج.", category: "C" },
        { number: 29, text: "تستهويني أعمال الطباعة وإدخال البيانات على الكمبيوتر.", category: "C" },
        { number: 30, text: "يمكنني تنظيم وجدولة الاجتماعات بشكل جيد لمختلف الإدارات التي أعمل معها.", category: "C" }
    ];

    const form = document.getElementById('hollandForm');

    questions.forEach((question) => {
        const questionCard = document.createElement('div');
        questionCard.className = 'card jjj';
        questionCard.innerHTML = `
            <div class="card-header">
                سؤال ${question.number}
            </div>
            <div class="card-body">
                <p>${question.text}</p>
                <div class="options" data-name="q${question.number}" data-category="${question.category}"></div>
            </div>
        `;
        form.appendChild(questionCard);
    });

    const optionsContainers = document.querySelectorAll('.options');

    optionsContainers.forEach(container => {
    const name = container.getAttribute('data-name');
    // Define emoji array in sequence from worst to best feeling
    const emojis = ['😣', '😩', '😔', '😕', '🥺', '😮', '😌', '🙂', '😃', '🤩'];
    
    for (let i = 1; i <= 10; i++) {
        const label = document.createElement('label');
        const input = document.createElement('input');
        input.type = 'radio';
        input.name = name;
        input.value = i;  // Keep the numeric value for calculations
        label.appendChild(input);
        label.appendChild(document.createTextNode(` ${emojis[i-1]}`));  // Use emoji instead of number
        container.appendChild(label);
    }
});

    const submitButton = document.createElement('button');
    submitButton.type = 'submit';
    submitButton.className = 'btn btn-primary';
    submitButton.textContent = 'إرسال';
    form.appendChild(submitButton);

    form.addEventListener('submit', function(event) {
    event.preventDefault();

    const results = {
        R: 0,
        I: 0,
        A: 0,
        S: 0,
        E: 0,
        C: 0
    };

    const answersToSave = [];

    questions.forEach((question) => {
        const container = document.querySelector(`[data-name="q${question.number}"]`);
        const selected = container.querySelector('input[type="radio"]:checked');
        if (selected) {
            const answer = parseInt(selected.value);
            results[question.category] += answer;

            answersToSave.push({
                question_number: question.number,
                question_text: question.text,
                category: question.category,
                answer: answer
            });
        }
    });

    const sortedResults = Object.entries(results)
        .filter(([_, score]) => score > 0)
        .sort((a, b) => b[1] - a[1]);

    const topThree = sortedResults.slice(0, 3);

    // Save results to the database
    fetch('{{ route("holland-test.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            user_id: {{ Auth::id() }}, // Assuming you're using Laravel's built-in authentication
            results: answersToSave,
            top_three: topThree
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Results saved:', data);
        displayResults(results);
        document.getElementById('hollandForm').style.display = 'none'; // Hide form after submission
    })
    .catch(error => {
        console.error('Error saving results:', error);
    });
});


    function displayResults(results) {
        const sortedResults = Object.entries(results)
            .filter(([_, score]) => score > 0)
            .sort((a, b) => b[1] - a[1]);
        
        const topThree = sortedResults.slice(0, 3);

        const resultsContainer = document.getElementById('results');
        resultsContainer.innerHTML = '<h2>نتائجك الثلاثة الأعلى</h2>';

        const resultRow = document.createElement('div');
        resultRow.className = 'row';

        topThree.forEach(([category, score]) => {
            const col = document.createElement('div');
            col.className = 'col-md-4 mb-3';

            const resultBox = document.createElement('div');
            resultBox.className = 'card text-center';
            resultBox.innerHTML = `
                <div class="card-body">
                    <h5 class="card-title">${getCategoryName(category)}</h5>
                    <p class="card-text">${score}</p>
                </div>
            `;

            col.appendChild(resultBox);
            resultRow.appendChild(col);
        });

        resultsContainer.appendChild(resultRow);
    }

    function getCategoryName(category) {
        const categoryNames = {
            'R': 'العملي',
            'I': 'الباحث',
            'A': 'الفني',
            'S': 'الاجتماعي',
            'E': 'المبادر',
            'C': 'الإداري'
        };
        return categoryNames[category] || category;
    }
});
</script>

@endsection
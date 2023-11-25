@extends('layouts.app')
@section('content')
    <style>
        .accordion {
            background-color: #4da3ff;
            color: white;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 20px;
            transition: 0.4s;
            border-radius: 10px;

        }

        .active, .accordion:hover {
            background-color: #007bff;
        }

        .accordion:after {
            content: '\002B';
            color: black;
            font-weight: bold;
            float: right;
            margin-left: 20px;
        }

        .active:after {
            content: "\2212";
        }

        .panel {
            padding: 0 18px;
            background-color: #e6f2ff;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            border-radius: 10px;
        }
    </style>
    <div class="container" style="margin-top: 10px;">
        <button class="accordion" > С какого возраста детский сад принимает детей? </button>
            <div class="panel">
                <div class="position-relative table-responsive"><br>
                    <p>Мы принимаем детей в возрасте от 2-х лет, иногда в более раннем возрасте, если ребенок легко переносит разлуку с мамой и адаптация происходит безболезненно.</p>
                </div>
            </div>
            <br>
        <button class="accordion" style="background-color: #5D3FB6">  Режим работы детского сада?  </button>
        <div class="panel">
            <div class="position-relative table-responsive"><br>
                <p>Для удобства родителей, детский сад работает с 8.00 утра до 18.30 вечера.</p>
            </div>
        </div>
        <br>
        <button class="accordion" style="background-color: #8EB542"> Делаете ли вы перерасчет в случае отсутствия ребенка? </button>
        <div class="panel">
            <div class="position-relative table-responsive"><br>
                <p>Мы делаем перерасчет в случае отсутствия ребенка более трех дней.</p>
            </div>
        </div>
        <br>
        <button class="accordion" style="background-color: #FAD01A"> Какие вещи ребенка надо будет принести в детский сад? </button>
        <div class="panel">
            <div class="position-relative table-responsive"><br>
                <p>Мы рекомендуем принести:
                    <br>- Комплект сменной одежды (футболочки, шортики, штанишки - для мальчиков, футболочки, платьица, юбочки - для девочек)
                    <br>- Комплект сменного белья (трусики, носочки)
                    <br>- Сменная обувь (удобнее на липучках)
                    <br>- Пижамка
                    <br>- Форма для занятий физкультурой и ритмикой (белая футболка, чешки, девочки – лосины, мальчики – шортики)
                    <br>- Расческа
                    <br>- Для самых маленьких - подгузники (на 1 день хватает 3-4 штуки)</p>
            </div>
        </div>
        <br>
        <button class="accordion" style="background-color: #F57C21"> Есть ли у вас вступительный взнос? </button>
        <div class="panel">
            <div class="position-relative table-responsive"><br>
                <p>У нас нет вступительного взноса.</p>
            </div>
        </div>
        <br>
        <button class="accordion" style="background-color: #EF4528"> Сколько групп в детском саду? </button>
        <div class="panel">
            <div class="position-relative table-responsive"><br>
                <p>В детском саду минимум 3 группы: младшая, средняя и старшая. На каждую группу- один воспитатель и нянечка.</p>
            </div>
        </div>
        <br>
    </div>
    <script>
        let acc = document.getElementsByClassName("accordion");
        let i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                let panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    </script>
@endsection

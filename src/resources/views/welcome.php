<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calculator</title>

        <!--  adding vue js   -->
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">

    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content" id="app">
                <div class="title m-b-md">
                    Calculator
                </div>
                <div class="sort-container">Equations
                    <input type="text" id="equation" onfocus="clearErrors()"/>
                    <button class="calculate" onclick="calculate()">Calculate</button>
                </div>
                <div class="error">{{error}}</div>
                <div class="sort-container">Answer
                    <input type="text" class="answer" disabled v-model="results"/>
                </div>

                <div class="calculations flex-container" >
                    <div class="title-calc">
                        <h4>Previous Calculations:</h4>
                    </div>
                    <div>
                        <ul>
                            <li class="calculation" v-for="calculation in calculations">{{calculation}}</li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>

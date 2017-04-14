<div class="row">
    <div class="col-md-12">
        <h2>Тестовое задание для  вакансии Junior PHP Developer.</h2>
        <p>
            <div><strong>Обязательные требования:</strong></div>
            <ul>
                <li>реализация на plain PHP;</li>
                <li>использование composer;</li>
                <li>DRY.</li>
            </ul>
        </p>
 
        <p>
            <div><strong>Опциональные требования, реализация станет плюсом:</strong></div>
            <ul>
                <li>OOP, SOLID</li>
                <li>реализация должна быть размещена в публичном репозитории (bitbucket, github)</li>
            </ul>
        </p>

        <p>
            <div><strong>Запрещается:</strong></div>
            <ul>
                <li>использовать фреймворки и их компоненты для реализации бекенда</li>
                <li>использовать чужие библиотеки для реализации бекенда</li>
            </ul>
        </p>

        <p>
            <div><strong>Разрешается:</strong></div>
            <ul>
                <li>использовать свои библиотеки (при условии подключения их через composer);</li>
                <li>использовать любое решение для фронтенда (any js framework or html/ajax)</li>
                <li>использовать любой удобный способ хранения данных</li>
            </ul>
        </p>

        <br />

        <h3>Задание (ориентировочное время выполнения 6-8 часов)</h3>
        
        <p>Реализовать Single Page Aplication с возможностью CRUD товаров, поля: name, description, price, status.</p>
        <ol>
            <li>
                По умолчанию, на странице выводится список товаров с кнопками "добавить", "редактировать", "удалить".
                <ol>
                    <li>Есть возможность выбрать сортировку по имени (в обе стороны) и по цене (по возрастанию и убыванию).</li>
                </ol>
            </li>
            <li>
                При нажатии на кнопку "редактировать", во всплывающем окне появляется форма для редактирования указанных полей и кнопка "сохранить".
                <ol>
                    <li>При редактировании указанных полей и нажатии на кнопку "сохранить", данные отправляются на сервер без перезагрузки страницы, всплывающее окно закрывается, соответствующая запись в списке изменяется.</li>
                </ol>
            </li>
            <li>
                При нажатии на кнопку "удалить", вместо соответствующей записи, без перезагрузки страницы, появляется надпись "Удалено" и ссылка "восстановить".
                <ol>
                    <li>При нажатии на ссылку "восстановить", без перезагрузки страницы, соответствующая запись восстанавливается в списке.</li>
                </ol>
            </li>
            <li>
                При нажатии на кнопку "Добавить", во всплывающем окне появляется форма для заполнения указанных полей и кнопка "сохранить".
                <ol>
                    <li>При заполнении указанных полей и нажатии на кнопку "сохранить", данные отправляются на сервер без перезагрузки страницы, всплывающее окно закрывается, соответствующая запись появляется в списке.</li>
                </ol>
            </li>
        </ol>
    </div>
</div>

<div style="margin-top:30px"><a href="/">Вернуться к товарам</a> </div>



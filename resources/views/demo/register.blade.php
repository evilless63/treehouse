
<h2>Юридическое лицо (ИП, ООО и так далее)</h2>

<form id="counteragentForm">

    @csrf

    <label for="counteragentInn">ИНН Организации:</label>
    <input type="text" id="counteragentInn" />
    <button id="getDataByInn">Найти по ИНН</button>

    <label for="counteragentOrgType">Тип организации:</label>
    <select id="counteragentOrgType">
        <option value=""></option>
        <option value="ООО">ООО</option>
        <option value="ОАО">ОАО</option>
        <option value="ЗАО">ЗАО</option>
        <option value="ТОО">ТОО</option>
        <option value="АО">АО</option>
        <option value="ИП">ИП</option>
        <option value="ПБОЮЛ">ПБОЮЛ</option>
        <option value="ГУП">ГУП</option>
    </select>

    <label for="counteragentKpp">КПП Организации:</label>
    <input type="text" id="counteragentKpp" />

    <label for="counteragentName">Наименование организации:</label>
    <input type="text" id="counteragentName" />

    <label for="counteragentRegistrationName">Наименование по регистрации (без типа юр.лица):</label>
    <input type="text" id="counteragentRegistrationName" /> 

    <label for="counteragentAddress">Юридический адрес:</label>
    <input type="text" id="counteragentAddress" />

    <label for="counteragentAddress">Фактический адрес:</label>
    <input type="text" id="counteragentFactAddress" />

    <label for="counteragentRegion">Регион:</label>
    <input type="text" id="counteragentRegion" />

    <label for="counteragentCity">Город:</label>
    <input type="text" id="counteragentCity" />

    <label for="counteragentContactUserSurname">Фамилия контактного лица:</label>
    <input type="text" id="counteragentContactUserSurname" />

    <label for="counteragentContactUserName">Имя контактного лица:</label>
    <input type="text" id="counteragentContactUserName" />

    <label for="counteragentContactUserPatronymic">Отчество контактного лица:</label>
    <input type="text" id="counteragentContactUserPatronymic" />

    <label for="counteragentContactUserPosition">Должность контактного лица:</label>
    <input type="text" id="counteragentContactUserPosition" />

    <label for="counteragentContactPhone">Контактный телефон:</label>
    <input type="text" id="counteragentContactPhone" />

    <div>
        <label for="useForPhoneNotifications">Использовать телефон для уведомлений</label>
        <input type="checkbox" id="counteragentUsePhoneNotifications" />       
    </div>

    <label for="counteragentBankName">Название банка:</label>
    <input type="text" id="counteragentBankName" />

    <label for="counteragentBankBik">БИК банка:</label>
    <input type="text" id="counteragentBankBik" />

    <label for="counteragentBankKSchet">К/счет банка:</label>
    <input type="text" id="counteragentBankKSchet" />

    <label for="counteragentBankRSchet">Р/счет банка:</label>
    <input type="text" id="counteragentBankRSchet" />

    <label for="counteragentContactPhone">Email:</label>
    <input type="text" id="counteragentEmail" />

    <label for="counteragentPassword">Пароль (не менее 3х символов):</label>
    <input type="password" id="counteragentPassword" />

    <label for="counteragentPassword">Подтверждение пароля:</label>
    <input type="password" id="counteragentPasswordRepeat" />

    <input type="hidden" id="counteragentType" />

    <label for="counteragentPassword">Введите код (5 цифр):</label>
    <div class="form-group" id="refreshrecapcha">
    {!!captcha_img('flat')!!}
    </div>
    <input type="text" name="captcha" data-validation="required">
    <a id="refreshCapchaButton" href="javascript:void(0)">Обновить код</a>
    

    <div>
    <label>Я согласен(согласна) с <a href="{{route('policy')}}">политикой конфиденциальности</a></label>
        <input type="checkbox" />       
    </div>

    <input type="submit" value="Зарегестрировать" />

</form>

<h2>Физическое лицо</h2>

<form id="privatePersonForm">

    @csrf

    <label for="privatePersonRegion">Регион:</label>
    <input type="text" id="privatePersonRegion" name="privatePersonRegion" />

    <label for="privatePersonCity">Город:</label>
    <input type="text" id="privatePersonCity" name="privatePersonCity"/>

    <label for="privatePersonContactUserSurname">Фамилия:</label>
    <input type="text" id="privatePersonContactUserSurname" name="privatePersonContactUserSurname" />

    <label for="privatePersonContactUserName">Имя:</label>
    <input type="text" id="privatePersonContactUserName" name="privatePersonContactUserName" />

    <label for="privatePersonContactUserPatronymic">Отчество:</label>
    <input type="text" id="privatePersonContactUserPatronymic" name="privatePersonContactUserPatronymic"/>

    <label for="privatePersonContactPhone">Контактный телефон:</label>
    <input type="text" id="privatePersonContactPhone" name="privatePersonContactPhone" />

    <div>
        <label for="privatePersonUsePhoneNotifications">Использовать телефон для уведомлений</label>
        <input type="checkbox" id="privatePersonUsePhoneNotifications" name="privatePersonUsePhoneNotifications"/>       
    </div>

    <label for="privatePersonContactPhone">Email:</label>
    <input type="text" id="privatePersonEmail" name="privatePersonEmail" />

    <label for="privatePersonPassword">Пароль (не менее 3х символов):</label>
    <input type="password" id="privatePersonPassword" name="privatePersonPassword" />

    <label for="privatePersonPassword">Подтверждение пароля:</label>
    <input type="password" id="privatePersonPasswordRepeat" name="privatePersonPasswordRepeat" />

    <label for="privatePersonPassword">Введите код (5 цифр):</label>
    <div class="form-group" id="refreshrecapcha1">
    {!!captcha_img('flat')!!}
    </div>
    <input type="text" name="captcha" data-validation="required" name="captcha" >
    <a id="refreshCapchaButton1" href="javascript:void(0)">Обновить код</a>
    

    <div>
    <label>Я согласен(согласна) с <a href="{{route('policy')}}">политикой конфиденциальности</a></label>
        <input type="checkbox" name="policy"/>       
    </div>

    <input type="submit" value="Зарегестрировать" />

</form>

<script src="https://unpkg.com/imask"></script>
<script>

    //Маска телефона и почты
    let element = document.getElementById('counteragentContactPhone')
    let maskOptions = {
    mask: '+{7}(000)000-00-00'
    }
    let mask = IMask(element, maskOptions)

    let element1 = document.getElementById('privatePersonContactPhone')
    let maskOptions1 = {
    mask: '+{7}(000)000-00-00'
    }
    let mask1 = IMask(element1, maskOptions1)

    //Обновление капчи
    const buttonRecapcha = document.getElementById('refreshCapchaButton')
    const buttonRecapcha1 = document.getElementById('refreshCapchaButton1')

    buttonRecapcha.addEventListener('click',  async () => {
            let options = {
                method: "GET",
                datatype: 'html'
            }

            await fetch('/refereshcapcha', options).then((response) => {
                return response.text();
            })
            .then((data) => {        
                document.getElementById('refreshrecapcha').innerHTML = data
        })
    })
    buttonRecapcha1.addEventListener('click', async () => {
            let options = {
                method: "GET",
                datatype: 'html'
            }

            await fetch('/refereshcapcha', options).then((response) => {
                return response.text();
            })
            .then((data) => {         
                document.getElementById('refreshrecapcha1').innerHTML = data
        })
    })

    //Автозаполнение контактной информации
    const buttonQuery = document.getElementById('getDataByInn') 

    const url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party"
    const token = "f2f8669a272aebc114db336c8d10dc58aca6adad"
    buttonQuery.addEventListener('click', async (event) => {

        event.preventDefault();
        let query = document.getElementById('counteragentInn').value

        let options = {
            method: "POST",
            mode: "cors",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "Authorization": "Token " + token
            },
            body: JSON.stringify({query: query})
        }
        
        let response = await fetch(url, options)

        if(response.ok) {
            let result = await response.json()
            if(result.suggestions.length > 0) {

                console.log(result.suggestions[0].data.name.kpp)

                if(result.suggestions[0].data.opf.short !== null)
                orgtypes = document.getElementById('counteragentOrgType').options
                for(let i = 0; i < orgtypes.length; i++) {
                    orgtype = orgtypes[i]
                    if(orgtype.value.toLowerCase() == result.suggestions[0].data.opf.short.toLowerCase()) 
                    orgtype.selected = true
                }


                if(result.suggestions[0].data.name.kpp !== undefined)
                document.getElementById('counteragentKpp').value = result.suggestions[0].data.name.kpp

                document.getElementById('counteragentName').value = result.suggestions[0].data.name.short_with_opf
                document.getElementById('counteragentRegistrationName').value = result.suggestions[0].data.name.full
                document.getElementById('counteragentAddress').value = result.suggestions[0].data.address.unrestricted_value

                document.getElementById('counteragentType').value = result.suggestions[0].data.type

                if(result.suggestions[0].data.address.data.street !== null)
                document.getElementById('counteragentAddress').value = document.getElementById('counteragentAddress').value + ', ул. ' + result.suggestions[0].data.address.data.street
               
                if(result.suggestions[0].data.address.data.house !== null)
                document.getElementById('counteragentAddress').value = document.getElementById('counteragentAddress').value + ', д. ' + result.suggestions[0].data.address.data.house
                
                if(result.suggestions[0].data.address.data.block !== null)
                document.getElementById('counteragentAddress').value = document.getElementById('counteragentAddress').value + ', корпус ' + result.suggestions[0].data.address.data.block
               
                if(result.suggestions[0].data.address.data.flat !== null)
                document.getElementById('counteragentAddress').value = document.getElementById('counteragentAddress').value + ', кв. ' + result.suggestions[0].data.address.data.flat
            
                document.getElementById('counteragentRegion').value = result.suggestions[0].data.address.data.region_with_type

                document.getElementById('counteragentCity').value = result.suggestions[0].data.address.data.city

                
            }
            
        } else {
            console.log('something is wrong !')
        }
        
    })
    
    counteragentForm.onsubmit = async (e) => {
        e.preventDefault();

        let response = await fetch('/register-counteragent', {
        method: 'POST',
        body: new FormData(counteragentForm)
        });

        let result = await response.json();

        console.log(result.message)
    };

    privatePersonForm.onsubmit = async (e) => {
        e.preventDefault()

        let response = await fetch('/register-counteragent', {
        method: 'POST',
        body: new FormData(privatePersonForm)
        })

        let result = await response.json()

        console.log(result.message)
    }

</script>
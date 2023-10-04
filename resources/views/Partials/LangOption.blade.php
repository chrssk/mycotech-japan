<div class="d-flex justify-content-end">
    <div class="col-1">
        <label for="lang" class="col-form-label">Language</label>
    </div>
    <div class="col-auto">
        <select onchange="changeLanguage(this.value)" class="form-select col-2">
            <option {{session()->has('lang_code')?(session()->get('lang_code')=='en'?'selected':''):''}} value="en">English</option>
            <option {{session()->has('lang_code')?(session()->get('lang_code')=='jp'?'selected':''):''}} value="jp">Japanese</option>
        </select>
    </div>
</div>
<script>
    function changeLanguage(lang){
        window.location='{{url("change-language")}}/'+lang;
    }
</script>
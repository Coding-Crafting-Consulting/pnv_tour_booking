@if($errors->any())
  <div class="alert alert-danger">
    @foreach ($errors->all() as $error)
      <div>{!! $error !!}</div>
    @endforeach
  </div>
@endif


<form
  data-controller="form"
  data-action="submit->form#submit"
  data-form-action="{!! $action !!}"
  data-form-method="post"
  
  @isset ($redirect)
    data-form-redirect="{!! $redirect !!}"
  @endisset
  
  enctype="multipart/form-data"
>
  @csrf

  @if($user['id'] != NULL)
    @method('PATCH')
    <input type="hidden" name="id" value="{!! $user['id'] !!}">
  @endif 
  
  <div class="row my-padding-bottom-19">
    <div class="col-md-3 col-lg-4 my-padding-bottom-8">
      <label for="title_id">Title:<label>
    </div>
    
    <div class="col-md-9 col-lg-8 my-padding-bottom-8">
      <select name="title_id" class="form-control" id="title_id">
        
        @foreach ($titles as $title)
          <option
            value="{!! $title['id'] !!}"
            {!!
                old (
                  'title_id',
                  isset($user) && $user['title_id'] == $title['id'] ? 'selected' : NULL )
            !!}
          >
            {!! $title['label'] !!}
          </option>
        @endforeach

      </select>
    </div>
  </div>

  <div class="row my-padding-bottom-19">
    <div class="col-md-3 col-lg-4 my-padding-bottom-8">
      <label for="last_name">Last name:<label>
    </div>
    
    <div class="col-md-9 col-lg-8 my-padding-bottom-8">
      <input
        id="last_name"
        type="text"
        class="form-control"
        name="last_name"
        value="{!! old ('last_name',isset($user)?$user['last_name']:NULL) !!}"
      >
    </div>
  </div>

  <div class="row my-padding-bottom-19">
    <div class="col-md-3 col-lg-4 my-padding-bottom-8">
      <label for="middle_name">Middle name:<label>
    </div>
    
    <div class="col-md-9 col-lg-8 my-padding-bottom-8">
      <input
        id="middle_name"
        type="text"
        class="form-control"
        name="middle_name"
        value="{!! old ('middle_name',isset($user)?$user['middle_name']:NULL) !!}"
      >
    </div>
  </div>

  <div class="row my-padding-bottom-19">
    <div class="col-md-3 col-lg-4 my-padding-bottom-8">
      <label for="first_name">First Name:<label>
    </div>
    
    <div class="col-md-9 col-lg-8 my-padding-bottom-8">
      <input
        id="first_name"
        type="text"
        class="form-control"
        name="first_name"
        value="{!! old ('first_name',isset($user)?$user['first_name']:NULL) !!}"
      >
    </div>
  </div>


  {{-- if user has admin rights and is not editing him/herself --}}
  {{-- else, register as customer --}}
  @if (!Auth::check())

    <input type="hidden" name="user_type_id" value="1">


  @elseif (Auth::id() == $user->id)

    <input
      type="hidden"
      name="user_type_id"
      value="{!! old ('user_type_id',isset($user)?$user['user_type_id']:1) !!}"
    >

  
  @elseif (Auth::user()->hasAdminRights())

    <div class="row my-padding-bottom-19">
      <div class="col-md-3 col-lg-4 my-padding-bottom-8">
        <label for="user_type_id">User category:<label>
      </div>
      
      <div class="col-md-9 col-lg-8 my-padding-bottom-8">
        <select name="user_type_id" class="form-control" id="user_type_id">
          
          @foreach ($userTypes as $userType)
            <option
              value="{!! $userType['id'] !!}"
              {!!
                  old (
                    'user_type_id',
                    isset($user) && $user['user_type_id'] == $userType['id'] ? 'selected' : NULL )
              !!}
            >
              {!! $userType['label'] !!}
            </option>
          @endforeach

        </select>
      </div>
    </div>


  @else

    <input type="hidden" name="user_type_id" value="1">


  @endif


  <div class="row my-padding-bottom-19">
    <div class="col-md-3 col-lg-4 my-padding-bottom-8">
      <label for="date_of_birth">Date of birth:<label>
    </div>
    
    <div class="col-md-9 col-lg-8 my-padding-bottom-8">
      <input
        id="date_of_birth"
        type="text"
        class="form-control datepicker"
        name="date_of_birth"
        placeholder="yyyy-mm-dd"
        autocomplete="off"
        value="{!! old ('date_of_birth',isset($user)?$user['date_of_birth']:NULL) !!}"
      >
    </div>
  </div>

  <div class="row my-padding-bottom-19">
    <div class="col-md-3 col-lg-4 my-padding-bottom-8">
      <label for="email">Email:<label>
    </div>
    
    <div class="col-md-9 col-lg-8 my-padding-bottom-8">
      <input
        id="email"
        type="email"
        class="form-control"
        name="email"
        value="{!! old ('email',isset($user)?$user['email']:NULL) !!}"
      >
    </div>
  </div>

  <div class="row my-padding-bottom-19">
    <div class="col-md-3 col-lg-4 my-padding-bottom-8">
      <label for="phone">Phone:<label>
    </div>
    
    <div class="col-md-9 col-lg-8 my-padding-bottom-8">
      <input
        id="phone"
        type="tel"
        class="form-control"
        name="phone"
        value="{!! old ('phone',isset($user)?$user['phone']:NULL) !!}"
      >
    </div>
  </div>

  <div class="row my-padding-bottom-19">
    <div class="col-md-3 col-lg-4 my-padding-bottom-8">
      <label for="address">Address:<label>
    </div>
    
    <div class="col-md-9 col-lg-8 my-padding-bottom-8">
      <textarea
        rows="4"
        id="address"
        class="form-control"
        name="address"
      >{!! old ('address',isset($user)?$user['address']:NULL) !!}</textarea>
    </div>
  </div>

  <div class="row my-padding-bottom-19">
    <div class="col-md-3 col-lg-4 my-padding-bottom-8">
      <label for="country_id">Nationality:<label>
    </div>
    
    <div class="col-md-9 col-lg-8 my-padding-bottom-8">
      <select name="country_id" class="form-control" id="country_id">
        
        @foreach ($countries as $country)
          <option
            value="{!! $country['id'] !!}"
            {!!
                old (
                  'country_id',
                  isset($user) && $user['country_id'] == $country['id'] ? 'selected' : NULL )
            !!}
          >
            {!! $country['label'] !!}
          </option>
        @endforeach

      </select>
    </div>
  </div>


  <div class="row my-padding-bottom-19">
    <div class="col-md-3 col-lg-4 my-padding-bottom-8">
      <label for="identification_type_id">Identification type:<label>
    </div>
    
    <div class="col-md-9 col-lg-8 my-padding-bottom-8">
      <select name="identification_type_id" class="form-control" id="identification_type_id">
        
        @foreach ($identificationTypes as $identificationType)
          <option
            value="{!! $identificationType['id'] !!}"
            {!!
                old (
                  'identification_type_id',
                  isset($user) && $user['identification_type_id'] == $identificationType['id'] ? 'selected' : NULL )
            !!}
          >
            {!! $identificationType['label'] !!}
          </option>
        @endforeach

      </select>
    </div>
  </div>

  <div class="row my-padding-bottom-19">
    <div class="col-md-3 col-lg-4 my-padding-bottom-8">
      <label for="identification_number">Identification number:<label>
    </div>
    
    <div class="col-md-9 col-lg-8 my-padding-bottom-8">
      <input
        id="identification_number"
        type="text"
        class="form-control"
        name="identification_number"
        value="{!! old ('identification_number',isset($user)?$user['identification_number']:NULL) !!}"
      >
    </div>
  </div>


  <!-- password -->

  <div class="row my-padding-bottom-19">
    <div class="col-md-3 col-lg-4 my-padding-bottom-8">
      <label for="password">Password:<label>
    </div>
  
    <div class="col-md-9 col-lg-8 my-padding-bottom-8">
      <input
        id="password"
        type="password"
        class="form-control"
        name="password"
      >
    </div>
  </div>

  <div class="row my-padding-bottom-19">
    <div class="col-md-3 col-lg-4 my-padding-bottom-8">
      <label for="password">Password confirmation:<label>
    </div>
  
    <div class="col-md-9 col-lg-8 my-padding-bottom-8">
      <input
        id="password-confirmation"
        type="password"
        class="form-control"
        name="password_confirmation"
      >
    </div>
  </div>


  <!-- button Save -->
  <div class="row">
    <div class="col-md-3 col-lg-4"></div>

    <div class="col-md-9 col-lg-8">
      <a
        href="{!! route('users.index') !!}"
        class="btn btn-sm btn-outline-dark my-margin-right-8 my-margin-bottom-8"
      >
        <i class="far fa-arrow-alt-circle-left my-margin-right-12"></i>
        <span>Back to list of users</span>
      </a>

      <button
        type="submit"
        class="btn btn-sm btn-success {!! isset($user['image']) ? ' my-margin-right-8 ' : '' !!}my-margin-bottom-8"
      >
        <i class="fas fa-check-circle my-margin-right-12"></i>
        <span>Save</span>
      </button>

    </div>
  </div>

</form>
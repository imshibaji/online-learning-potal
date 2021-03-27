@extends('layouts.user')

@section('content')
<div id="app" class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Gems Details</div>

                <div class="card-body" style="min-height: 600px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row justify-content-center">
                        <div class="col-md-5 col-12 text-center">
                            <h4>Your Referal Code:</h4>
                            <div class="shadow-none p-3 mb-5 bg-light rounded"> {{ url('/').'?ref='.Auth::id() }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Your referal income: 300 Gems</h4>
                            <p class="muted">1 Gem = 1 Rupee</p>
                            <table class="table table-striped table-inverse">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Purpose</th>
                                        <th>Date</th>
                                        <th>Points</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row">You was joined.</td>
                                            <td>1st March 2020</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Sonu Show was joined.</td>
                                            <td>3rd March 2020</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Monu Jain was joined.</td>
                                            <td>11th March 2020</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Sonu Show was joined.</td>
                                            <td>3rd March 2020</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Monu Jain was joined.</td>
                                            <td>11th March 2020</td>
                                            <td>100</td>
                                        </tr>
                                    </tbody>
                            </table>

                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                  <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                  </li>
                                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                  <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                  </li>
                                </ul>
                              </nav>
                        </div>
                        <div class="col-md-4 col-12 shadow p-3 mb-5 bg-white rounded">
                            <h3 class="text-center">User Information</h3>
                            <form>
                                <div class="form-group">
                                    <label for="inputName">Name</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="Input Name">
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" placeholder="Input Email">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="inputMobile">Mobile</label>
                                    <input type="text" class="form-control" id="inputMobile" placeholder="Input Mobile">
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMessage">Message</label>
                                    <textarea class="form-control" id="inputMessage" placeholder="Input Details"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                              </form>
                        </div>
                    </div>
                    {{-- Page End Here --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
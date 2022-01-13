<div class="header">
    <a class="header-brand flex-grow-1" href="#">
        <img src="/images/logo.png" width="50" height="50" class="d-inline-block ms-5" alt="Deliciuos Logo">
        <span class="align-middle fw-bolder fs-3 fst-italic">Delicious</span>
    </a>

    <div class="header-nav mr-auto align-items-end">
        <a class="nav-item nav-link active" data-coreui-target="#loginModal" data-coreui-toggle="modal"
        style="cursor: pointer">Login <span class="visually-hidden">(current)</span></a>


        <a class="nav-item nav-link" href="#">Mypage</a>
    </div>
    <form class="d-flex">
        <input class="form-control" type="search" aria-label="Search" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
        <button class="btn btn-outline-secondary" type="submit" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
            <img src="/images/magnifying-glass.png"></button>
    </form>
</div>
{{-- �α��θ�� --}}
<div class="modal" id="loginModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">�α���</h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="inputEmail" class="form-label">Email</label>
          <input type="email" class="form-control" id="inputEmail" placeholder="email@email.com">
          <label for="inputPassword" class="form-label">Password</label>
          <input type="password" class="form-control" id="inputPassword" placeholder="6~12�ڸ��� ����,����, Ư������ ����">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
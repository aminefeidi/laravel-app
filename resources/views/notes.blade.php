<x-app-layout>
    <div class="card my-4">
        <div class="card-body">
            <form action="{{ route('notes') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="feuil" class="form-label">Feuil</label>
                        <input class="form-control" id="feuil" name="feuil"></input>
                    </div>
                    <div class="mb-3">
                        <label for="libelle" class="form-label">Libelle</label>
                        <input class="form-control" id="libelle" name="libelle"></input>
                    </div>
                    <div class="row mb-3">
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="type" id="PNC" value="PNC">
                            <label class="form-check-label" for="PNC">
                                PNC
                            </label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="type" id="PNT" value="PNT">
                            <label class="form-check-label" for="PNT">
                                PNT
                            </label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">Base:</div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="type" id="TUN" value="TUN">
                            <label class="form-check-label" for="TUN">
                                TUN
                            </label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="type" id="DJR" value="DJR">
                            <label class="form-check-label" for="DJR">
                                DJR
                            </label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="type" id="MIR" value="MIR">
                            <label class="form-check-label" for="MIR">
                                MIR
                            </label>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">Secteur:</div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="xs" id="A" value="A">
                            <label class="form-check-label">
                                A32
                            </label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="xs" id="B" value="B">
                            <label class="form-check-label">
                                36
                            </label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="xs" id="C" value="C">
                            <label class="form-check-label">
                                737
                            </label>
                        </div>
                        <div class="col form-check">
                          <input class="form-check-input" type="radio" name="xs" id="D" value="D">
                          <label class="form-check-label">
                              A32
                          </label>
                      </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

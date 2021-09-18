<form wire:submit.prevent="confirmEnroll">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="month">No of Month</label>
                <input type="number" wire:model="month" class="form-control" id="month"
                    placeholder="Enter the no. of month that you want to connect" required>
                @error('month')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="___class_+?6___" for="amount">Money</label>
                <input type="text" wire:model="amount" class="form-control" id="amount" placeholder="You have to pay "
                    required disabled>
                @error('amount')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="name">Student Name</label>
        <input type="text" wire:model="name" class="form-control" id="name" placeholder="Enter your name .. " required
            disabled>
        @error('name')
            <p style="color: red">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Student Email:</label>
        <input type="email" wire:model="email" class="form-control" id="email"
            placeholder="Enter your email address .." required disabled>
        @error('email')
            <p style="color: red">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="contact">Student contact number:</label>
        <input type="tel" wire:model="contact" class="form-control" id="contact" placeholder="Student contact number"
            required>
        @error('contact')
            <p style="color: red">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="paymentMethod">Payment method</label>
        <select id="paymentMethod" wire:model="method" class="form-control custom-select" required>
            <option selected>Selct one</option>
            <option value="Bkash">Bkash</option>
            <option value="Nogod">Nagad</option>
            <option value="Rocket">Rocket</option>
        </select>
        @error('method')
            <p style="color: red">{{ $message }}</p>
        @enderror
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="transectionNumber">Transaction number</label>
                <input type="tel" wire:model="transectionNumber" class="form-control" id="transectionNumber"
                    placeholder="Transaction phone number" required>
                @error('transectionNumber')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="transectionID">Transaction ID</label>
                <input type="tel" class="form-control" id="transectionID" wire:model="transectionID"
                    placeholder="Transaction ID" required>
                @error('transectionID')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <div wire:loading wire:target="confirmEnroll">
        <p style="color: indigo">Wait a minute. Your payment is processing.</p>
    </div>
</form>

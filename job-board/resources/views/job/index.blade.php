<x-layout>
  <x-breadcrumbs class="mb-4" 
    :links="['Jobs' => route('jobs.index')]"/>

    <x-card class="mb-4 text-sm">
      <form id="filtering-form" action="{{ route('jobs.index') }}" method="GET">
        <div class="mb-4 grid grid-cols-2 gap-4">
          <div>
            <div class="mb-1 font-semibold">Search</div>
            <x-text-input name="search" value="{{ request('search') }}" placeholder="Search for any text" form-id="filtering-form" />
          </div>
          <div>
            <div class="mb-1 font-semibold">Salary</div>
    
            <div class="flex space-x-2">
              <x-text-input name="min_salary" value="{{ request('min_salary') }}" placeholder="From" form-id="filtering-form" />
              <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeholder="To" form-id="filtering-form" />
            </div>
          </div>

          <div>
            <div class="mb-1 font-semibold">Experience</div>
            <div>
              <x-radio-group name="experience" :options="\App\Models\Job::$experiences" />
            </div>
          </div>
          <div>
            <div class="mb-1 font-semibold">Categories</div>
            <div>
              <x-radio-group name="category" :options="\App\Models\Job::$categories" />
            </div>
          </div>
        </div>

        <button type="submit" class="w-full">Filter</button>
      </form>
    </x-card>

    @foreach ($jobs as $job)
      <x-job-card class="mb-4" :job="$job">
        <div>
          <x-link-button :href="route('jobs.show', $job)">
            Show
          </x-link-button>
        </div>
      </x-job-card>
    @endforeach
  </x-layout>
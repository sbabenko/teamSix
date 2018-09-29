from django.shortcuts import render

# Create your views here.
from events.models import *

from django.contrib.auth.decorators import login_required
from django.views.decorators.cache import never_cache
from django.http import HttpResponseRedirect
from django.urls import reverse
from django.shortcuts import redirect


@never_cache
@login_required
def index(request):
    """View function for home page of site."""

    context = {
      
    }

    if request.user.groups.filter(name="First Responders").exists():
        # user is an admin
        return redirect("first_respond_dash_view")
    elif request.user.groups.filter(name="Mission Management Specialists").exists():
        return redirect("miss_mgmt_dash_view")
    elif request.user.groups.filter(name="Operations Chiefs").exists():
        return redirect("ops_chief_dash_view")
    else:
        return render(request, 'index.html', context=context)
    # Render the HTML template index.html with the data in the context variable
  